<?php
// app/controllers/Ricardo_painelC.php
require_once __DIR__ . '/../models/Ricardo_painel.php'; // ajusta se seu model tiver outro nome

class Ricardo_painelC {
    public static function add() {
        $titulo = trim($_POST['titulo'] ?? '');
        $autor  = trim($_POST['autor'] ?? '');
        $sinopse = trim($_POST['sinopse'] ?? '');
        $reservado = isset($_POST['reservado']) && ($_POST['reservado'] === 'on' || $_POST['reservado'] === '1');

        // chama o model (supondo RicardoModel::add já existe)
        $id = RicardoModel::add([
            'titulo' => $titulo,
            'autor' => $autor,
            'reservado' => $reservado,
            'sinopse' => $sinopse
        ]);
        return $id;
    }

    public static function delete() {
        $id = $_POST['id'] ?? null;
        if ($id !== null) {
            RicardoModel::remove(intval($id));
            return true;
        }
        return false;
    }

    public static function handleRequest() {
        $method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
        if ($method === 'POST') {
            $action = $_POST['action'] ?? '';
            if ($action === 'add') {
                self::add();
            } elseif ($action === 'delete') {
                self::delete();
            }
            // volta para a página anterior (ou ajuste para uma URL fixa)
            $back = $_SERVER['HTTP_REFERER'] ?? '/';
            header('Location: ' . $back);
            exit;
        }
        // se GET, só mostra mensagem simples (não necessário)
        header('HTTP/1.1 405 Method Not Allowed');
        echo "Method not allowed";
        exit;
    }
}
