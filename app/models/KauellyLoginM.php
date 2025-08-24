<?php
class UsuarioModel{
    private $caminhoDadosJson;
    public function __construct(){
        $this->caminhoDadosJson = __DIR__ . '/../data/usuarios.json';
    }

    public function salvar($usuario){
        $dados = [];
        if(file_exists($this->caminhoDadosJson)){
            $conteudo = file_get_contents($this->caminhoDadosJson);
            $dados = json_decode($conteudo, true);

            if (!is_array($dados)){
                $dados = [];
            }
        }
        $dados[] = $usuario;
        file_put_contents(
            $this->caminhoDadosJson,
            json_encode($dados, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)
        );
    }
    
    private function carregarUsuarios(){
        if (!file_exists($this->caminhoDadosJson)){
            return []; //retorna array VAZIOZIN se o JSON n existir
        }
        $json = file_get_contents($this->caminhoDadosJson);
        return json_decode($json, true) ?? [];
    }

    public function cadastrarUsuario($email, $senha){
        $usuarios = $this->carregarUsuarios();
        foreach($usuarios as $usuario){
            if($usuario['email'] === $email){
                return false;
            }
        }
        $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
        $usuarios[] = ['email' => $email, 'senha' => $senhaHash];

        //salva no Jaizinn
        file_put_contents($this->caminhoDadosJson, json_encode($usuarios, JSON_PRETTY_PRINT));
        return true; //cadastrado!!
    }

    public function autenticar($email, $senha){
        $usuarios = $this->carregarUsuarios();
        foreach ($usuarios as $usuario) {
            if ($usuario['email'] === $email && password_verify($senha, $usuario['senha'])) {
                return true;
            }
        }
        return false;
    }

}