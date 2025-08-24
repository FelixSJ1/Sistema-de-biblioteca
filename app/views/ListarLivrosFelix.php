<?php
require_once __DIR__ . '/../controllers/Felix_ListarC.php';

$controller = new ControllerPrincipal();

if (isset($_POST['listar'])) {
    $livros = $controller->pegardados();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Livros</title>
    <link rel="stylesheet" href="../../public/assets/css/Pagina_ListarF.css">
</head>
<body>

<div class="container">
        <h1>Lista de Livros</h1>

<form method="post" class="form-listar">
<button type="submit" name="listar">Mostrar Livros</button>
</form>

 <?php if (!empty($livros)): ?>
 <div class="table-container">
     <table>
        <thead>
        <tr>
         <th>ID</th>
        <th>Título</th>
        <th>Autor</th>
         <th>Reservado</th>
         <th>Sinopse</th>
         </tr>
        </thead>
        <tbody>
    <?php foreach ($livros as $livro): ?>
        <tr>
            <td><?= $livro['id'] ?></td>
            <td><?= $livro['titulo'] ?></td>
            <td><?= $livro['autor'] ?></td>
            <td><?= $livro['reservado'] ? 'Sim' : 'Não' ?></td>
            <td><?= isset($livro['sinopse']) ? $livro['sinopse'] : '-' ?></td> 
        </tr>
    <?php endforeach; ?>
        </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>

</body>
</html>
