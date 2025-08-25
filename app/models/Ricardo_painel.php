<?php
// app/models/Ricardo_painel.php
class RicardoModel {
    private static function getFilePath() {
        // caminho para app/data/livros.json
        return __DIR__ . '/../data/livros.json';
    }

    public static function getAll() {
        $file = self::getFilePath();
        if (!file_exists($file)) return [];
        $json = @file_get_contents($file);
        if ($json === false) return [];
        $arr = json_decode($json, true);
        if (!is_array($arr)) return [];
        return $arr;
    }

    private static function saveAll(array $items) {
        $file = self::getFilePath();
        $dir = dirname($file);
        if (!is_dir($dir)) {
            if (!@mkdir($dir, 0755, true)) {
                throw new Exception("Não foi possível criar a pasta de dados: $dir");
            }
        }
        $json = json_encode($items, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        if ($json === false) {
            throw new Exception("Falha ao codificar JSON: " . json_last_error_msg());
        }
        $bytes = @file_put_contents($file, $json, LOCK_EX);
        if ($bytes === false) {
            throw new Exception("Falha ao escrever no arquivo de dados ($file). Verifique permissões.");
        }
    }

    private static function nextId(array $items) {
        $max = 0;
        foreach ($items as $it) {
            if (isset($it['id']) && is_numeric($it['id'])) {
                $val = intval($it['id']);
                if ($val > $max) $max = $val;
            }
        }
        return $max + 1;
    }

    public static function add(array $book) {
        $items = self::getAll();
        $bookId = self::nextId($items);
        $new = [
            "id" => $bookId,
            "titulo" => (string)($book['titulo'] ?? ''),
            "autor" => (string)($book['autor'] ?? ''),
            "reservado" => (bool)($book['reservado'] ?? false),
            "sinopse" => (string)($book['sinopse'] ?? ''),
            "resumo" => (string)($book['resumo'] ?? ''),
            "lancamento" => (string)($book['lancamento'] ?? '')
        ];
        $items[] = $new;
        self::saveAll($items);
        return $bookId;
    }

    public static function remove($id) {
        $items = self::getAll();
        $id = intval($id);
        $before = count($items);
        $items = array_values(array_filter($items, function($it) use ($id) {
            return intval($it['id']) !== $id;
        }));
        $after = count($items);
        if ($before !== $after) {
            self::saveAll($items);
        }
    }
}
