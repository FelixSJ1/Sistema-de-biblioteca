<?php

class ReservaModels {
    private $datafile;

    public function __construct() {
    
        $this->datafile = __DIR__ . '/../data/livros.json';
    }

    public function getAllLivros() {
        if (!file_exists($this->datafile)) {
            return [];
        }

        $data = file_get_contents($this->datafile);
        $livros = json_decode($data, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            echo "Erro ao decodificar JSON: " . json_last_error_msg();
            return [];
        }

        return is_array($livros) ? $livros : [];
    }

    public function updateLivroStatus($id, $reservado) {
        $livros = $this->getAllLivros();

        if (empty($livros)) {
            return false;
        }

        foreach ($livros as &$livro) {
            if ($livro['id'] == $id) {
                $livro['reservado'] = $reservado;

                $json = json_encode($livros, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
                if (file_put_contents($this->datafile, $json) !== false) {
                    return true;
                }
            }
        }
        return false;
    }
}
?>