<?php
session_start();
//verificaçãozinha aqui!!
$mensagem = '';
if(isset($_SESSION['mensagem'])){
    $mensagem = $_SESSION['mensagem'];
    unset($_SESSION['mensagem']); 
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro - Biblioteca</title>
    <style>
        body{
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .cadastro-container{
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0,0,0,0.1);
            width: 350px;
        }

        .cadastro-container h2{
            text-align: center;
            margin-bottom: 20px;
        }

        label{
            font-weight: bold;
        }

        input{
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        button{
            padding: 12px 30px;
            background: #007bff;
            border: none;
            border-radius: 5px;
            color: white;
            font-size: 16px;
            cursor: pointer;
            display: block;
            margin: 0 auto;
        }

        button:hover{
            background: #0056b3;
        }

        .erro{
            color: red;
            text-align: center;
            margin-bottom: 15px;
        }

        .mensagem{
            color: green;
            text-align: center;
            margin-bottom: 15px;
        }

        p.link{
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="cadastro-container">
        <h2>Cadastro de Usuário</h2>

        <?php if($mensagem): ?>
            <p class="mensagem"><?php echo htmlspecialchars($mensagem); ?></p>
        <?php endif; ?>

        <form action="../controllers/CadastroKauellyC.php" method="POST">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required placeholder="usuario@gmail.com">

            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha" required placeholder="sua senha">

            <button type="submit">Cadastrar</button>
        </form>

        <p class="link">
            Já tem uma conta? <a href="LoginKauelly.php">Faça login aqui</a>
        </p>
    </div>
</body>
</html>
