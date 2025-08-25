

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Biblioteca - Página Inicial</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #ffffff;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        h1 {
            margin-bottom: 40px;
            color: #333;
        }

        .btn-container {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .btn {
            background-color: #007BFF;
            color: white;
            padding: 15px 30px;
            text-decoration: none;
            border-radius: 8px;
            font-size: 16px;
            text-align: center;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h1>Sistema de Biblioteca</h1>
    <div class="btn-container">
        <a href="../app/views/ListarLivrosFelix.php" class="btn">📚 Listar Livros</a>
        <a href="../app/views/CadastroKauelly.php" class="btn">📝 Cadastro</a>
        <a href="../app/views/LoginKauelly.php" class="btn">🔑 Login</a>
        <a href="../app/views/PainelDeLivrosRicardo.php" class="btn">➕➖ Adicionar / Excluir Livros</a>
        <a href="../app/views/ReservaViews.php" class="btn">📖 Reservar Livros</a>
    </div>
</body>
</html>
