<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

require_once 'PokemonAPI.php';

// Handle preflight requests
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

try {
    $pokemonAPI = new PokemonAPI();
    
    // Get the endpoint from the URL
    $request = $_GET['request'] ?? '';
    
    switch ($request) {
        case 'pokemon':
            $identifier = $_GET['id'] ?? $_GET['name'] ?? '';
            
            if (empty($identifier)) {
                throw new Exception('Missing Pokemon identifier');
            }
            
            $pokemon = $pokemonAPI->getPokemon($identifier);
            echo json_encode($pokemon);
            break;
            
        case 'list':
            $limit = (int)($_GET['limit'] ?? 20);
            $offset = (int)($_GET['offset'] ?? 0);
            
            $pokemons = $pokemonAPI->getPokemonList($limit, $offset);
            echo json_encode(['pokemons' => $pokemons]);
            break;
            
        default:
            throw new Exception('Invalid request type');
    }
} catch (Exception $e) {
    http_response_code(400);
    echo json_encode(['error' => $e->getMessage()]);
}