<?php

require_once __DIR__ . '/../models/ReservaModels.php';

class ReservaControllers {
    private $livroModel;

    public function __construct() {
        $this->livroModel = new ReservaModels();
    }


    public function listLivros() {
        return $this->livroModel->getAllLivros();
    }

    public function reservarLivro($id) {
        $sucessoo = $this->livroModel->updateLivroStatus($id, true);

        if ($sucessoo) {
            header('Location: ' . $_SERVER['PHP_SELF']);
            exit;
        } else {
            echo "Erro ao reservar o livro.";
        }
    }
}
?>