<?php
require_once __DIR__ . '/../models/KauellyLoginM.php';

class LoginController{
    private $usuarioModel;
    public function __construct(){
        $this->usuarioModel = new UsuarioModel();
    }
    public function login($email, $senha){
        if ($this->usuarioModel->autenticar($email, $senha)){
            session_start();
            $_SESSION['usuario'] = $email;
            header("Location: ../public/index.php"); // página após login
            exit;
        } else{
            $erro = "Email ou senha incorretos!";
            header("Location: ../views/LoginKauelly.php?erro=Email ou senha incorretos!");
        }
    }
}
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $email = $_POST['email'] ?? '';
    $senha = $_POST['senha'] ?? '';
    $controller = new LoginController();
    $controller->login($email, $senha);
}
