<?php
// public/ricardo_controller.php
require_once __DIR__ . '/../app/models/Ricardo_painel.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    if ($action === 'add') {
        $titulo = trim($_POST['titulo'] ?? '');
        $autor = trim($_POST['autor'] ?? '');
        $sinopse = trim($_POST['sinopse'] ?? '');
        $resumo = trim($_POST['resumo'] ?? '');
        $lancamento = trim($_POST['lancamento'] ?? '');
        $reservado = isset($_POST['reservado']) && ($_POST['reservado'] === 'on' || $_POST['reservado'] === '1' || $_POST['reservado'] === 'true');

        try {
            RicardoModel::add([
                'titulo' => $titulo,
                'autor' => $autor,
                'reservado' => $reservado,
                'sinopse' => $sinopse,
                'resumo' => $resumo,
                'lancamento' => $lancamento
            ]);
            $back = $_SERVER['HTTP_REFERER'] ?? '/';
            header('Location: ' . $back);
            exit;
        } catch (Exception $e) {
            echo "Erro ao adicionar: " . htmlspecialchars($e->getMessage());
            exit;
        }
    }

    if ($action === 'delete') {
        $id = $_POST['id'] ?? null;
        if ($id === null || $id === '') {
            echo "Erro: id não fornecido.";
            exit;
        }
        try {
            RicardoModel::remove($id);
            $back = $_SERVER['HTTP_REFERER'] ?? '/';
            header('Location: ' . $back);
            exit;
        } catch (Exception $e) {
            echo "Erro ao remover: " . htmlspecialchars($e->getMessage());
            exit;
        }
    }
}

header('HTTP/1.1 405 Method Not Allowed');
echo "Method not allowed";
exit;
