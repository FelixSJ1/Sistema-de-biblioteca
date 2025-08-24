<?php
require_once __DIR__ . "/../models/KauellyLoginM.php";
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $email = $_POST['email'] ?? '';
    $senha = $_POST['senha'] ?? '';
    if(empty($email) || empty($senha)){
        header("Location: ../views/CadastroKauelly.php?erro=Preencha todos os campos.");
        exit;
    }
    $usuarioModel = new UsuarioModel();
    if($usuarioModel->cadastrarUsuario($email, $senha)){
        header("Location: ../views/LoginKauelly.php?msg=Cadastrado realizado com sucesso! Faça login.");
        exit;
    }else{
        header("Location: ../views/CadastroKauelly.php?erro=Email já cadastrado.");
        exit;
    }
}
