<?php

require_once __DIR__ . '/../models/ReservaModels.php';
require_once __DIR__ . '/../controllers/ReservaControllers.php';

$reservaModel = new ReservaModels();
$reservaController = new ReservaControllers($reservaModel);

if (isset($_GET['action']) && $_GET['action'] == 'reservar' && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $reservaController->reservarLivro($id);
} else {
    $livros = $reservaController->listLivros();
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Lista de Livros</title>
    <style>
        body {
            font-family: sans-serif;
            margin: 40px;
        }
        ul {
            list-style: none;
            padding: 0;
        }
        li {
            padding: 10px;
            border-bottom: 1px solid #dfd8d8ff;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .reservar-link {
            background-color: #408fbaff;
            color: white;
            padding: 5px 10px;
            text-decoration: none;
            border-radius: 6px;
        }
        .reservar-link:hover {
            background-color: #308d89ff;
        }
        h1 {
            color: #000000ff;
        }
    </style>
</head>
<body>
    <h1>Reservas disponíveis:</h1>
    <ul>
        <?php if (!empty($livros)): ?>
            <?php foreach ($livros as $livro): ?>
                <?php if ($livro['reservado'] == false): ?>
                    <li>
                        <span>
                            <?= htmlspecialchars($livro['titulo']) ?> por <?= htmlspecialchars($livro['autor']) ?>
                        </span>
                        <a href="?action=reservar&id=<?= htmlspecialchars($livro['id']) ?>" class="reservar-link">
                            Reservar
                        </a>
                    </li>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php else: ?>
            <li>Nenhum livro encontrado.</li>
        <?php endif; ?>
    </ul>
</body>
</html>
