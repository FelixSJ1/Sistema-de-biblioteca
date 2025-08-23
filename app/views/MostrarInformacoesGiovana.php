<?php
require_once __DIR__ . '/../controllers/Giovana_InformacoesC.php';


// Cria o controller
$controller = new ControllerDetalhes();


// Pega o ID do livro via URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;


// Busca o livro correspondente
$livro = $controller->pegarPorId($id);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Detalhes do Livro</title>
    <link rel="stylesheet" href="../../public/assets/css/Pagina_Informacoes.css">
</head>
<body>
<div class="container">
    <?php if ($livro): ?>
        <h1><?= htmlspecialchars($livro['titulo']) ?></h1>
        <p><strong>Autor:</strong> <?= htmlspecialchars($livro['autor']) ?></p>
        <p><strong>Lançamento:</strong> <?= htmlspecialchars($livro['lacamento']) ?></p>
        <p><strong>Reservado:</strong> <?= $livro['reservado'] ? 'Sim' : 'Não' ?></p>


        <h3>Resumo</h3>
        <p><?= htmlspecialchars($livro['resumo']) ?></p>
    <?php else: ?>
        <p>Livro não encontrado.</p>
    <?php endif; ?>


    <a href="ListarLivrosFelix.php">⬅ Voltar para lista de livros</a>
</div>
</body>
</html>



