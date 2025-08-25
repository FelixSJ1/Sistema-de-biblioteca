<?php


require_once __DIR__ . '/../models/Felix_listarM.php';


class ControllerDetalhes {


    public function pegarPorId(int $id): ?array {
        $dadosPegos = new Livro();
        $livros = $dadosPegos->getAll();


        foreach ($livros as $livro) {
            if ($livro['id'] == $id) {
                return $livro;
            }
        }
        return null;
    }
}