

<?php



class Livro {

public function getAll(): array{

    $arquivo = __DIR__ . '/../data/livros.json';

    if(!file_exists($arquivo)){
        return [];
    }

    $json = file_get_contents($arquivo);
    
    
    $data = json_decode($json, true);

    if($data == NULL){
        return [];
    }


    return $data;
}





}





?>