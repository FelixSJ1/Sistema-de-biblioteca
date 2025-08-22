<?php

require_once __DIR__ . '/../models/Felix_listarM.php';


class ControllerPrincipal{
        public function Pegardados() {
          
            $dadosPegos = new Livro();

            
            $livros = $dadosPegos->getAll();


            return $livros;

        }
    }



?>