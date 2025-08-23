<?php
define('JSON_PATH', __DIR__ . '/../data/livros.json');

function getLivrosData() {
    if (!file_exists(JSON_PATH)) {
        // Cria o arquivo se não existir
        file_put_contents(JSON_PATH, json_encode([], JSON_PRETTY_PRINT));
        return [];
    }
    
    $json = file_get_contents(JSON_PATH);
    $data = json_decode($json, true);
    
    // Verifica se o JSON foi decodificado corretamente
    if (json_last_error() !== JSON_ERROR_NONE) {
        return [];
    }
    
    return $data;
}

function saveLivrosData($data) {
    file_put_contents(JSON_PATH, json_encode($data, JSON_PRETTY_PRINT));
}