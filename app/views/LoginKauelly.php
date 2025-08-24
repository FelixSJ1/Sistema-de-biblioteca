<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Biblioteca</title>
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

        .login-container{
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0,0,0,0.1);
            width: 350px;
        }

        .login-container h2{
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
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        
        <?php 
        if(isset($_GET['erro'])){
            echo "<p class='erro'>" . htmlspecialchars($_GET['erro']) . "</p>";
        }
        if(isset($_GET['msg'])){
            echo "<p class='mensagem'>" . htmlspecialchars($_GET['msg']) . "</p>";
        }
        ?> 
        
        <form method="POST" action="../controllers/LoginKauellyC.php">
            <label>Email:</label>
            <input type="email" name="email" required placeholder="usuario@gmail.com">

            <label>Senha:</label>
            <input type="password" name="senha" required placeholder="sua senha">

            <button type="submit">Entrar</button>
        </form>

        <p style="text-align:center;">
            Não é cadastrado? <a href="CadastroKauelly.php">Cadastre-se aqui</a>
        </p>
    </div>
</body>
</html>
