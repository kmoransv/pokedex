<?php
require_once 'vendor/autoload.php';

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class PokemonAPI {
    private $client;
    private $baseUrl = 'https://pokeapi.co/api/v2';

    public function __construct() {
        $this->client = new Client([
            'base_uri' => $this->baseUrl,
            'timeout' => 10,
            'headers' => [
                'User-Agent' => 'Pokedex-PHP/1.0'
            ]
        ]);
    }

    /**
     * Fetch a single Pokemon by name or ID
     */
    public function getPokemon($identifier) {
        try {
            $response = $this->client->request('GET', "/pokemon/{$identifier}");
            $data = json_decode($response->getBody(), true);
            
            return $this->formatPokemonData($data);
        } catch (RequestException $e) {
            if ($e->hasResponse()) {
                $statusCode = $e->getResponse()->getStatusCode();
                if ($statusCode === 404) {
                    throw new Exception("Pokemon not found");
                }
            }
            throw new Exception("Error fetching Pokemon data: " . $e->getMessage());
        }
    }

    /**
     * Fetch a list of Pokemon
     */
    public function getPokemonList($limit = 20, $offset = 0) {
        try {
            $response = $this->client->request('GET', "/pokemon?limit={$limit}&offset={$offset}");
            $data = json_decode($response->getBody(), true);
            
            $pokemons = [];
            foreach ($data['results'] as $pokemon) {
                $pokemons[] = [
                    'name' => $pokemon['name'],
                    'url' => $pokemon['url']
                ];
            }
            
            return $pokemons;
        } catch (RequestException $e) {
            throw new Exception("Error fetching Pokemon list: " . $e->getMessage());
        }
    }

    /**
     * Format Pokemon data for easier use
     */
    private function formatPokemonData($data) {
        return [
            'id' => $data['id'],
            'name' => ucfirst($data['name']),
            'types' => array_map(function($type) {
                return $type['type']['name'];
            }, $data['types']),
            'height' => $data['height'] / 10, // Convert decimeters to meters
            'weight' => $data['weight'] / 10, // Convert hectograms to kilograms
            'stats' => [
                'hp' => $data['stats'][0]['base_stat'],
                'attack' => $data['stats'][1]['base_stat'],
                'defense' => $data['stats'][2]['base_stat'],
                'special-attack' => $data['stats'][3]['base_stat'],
                'special-defense' => $data['stats'][4]['base_stat'],
                'speed' => $data['stats'][5]['base_stat']
            ],
            'sprites' => [
                'front_default' => $data['sprites']['front_default'],
                'back_default' => $data['sprites']['back_default'],
                'front_shiny' => $data['sprites']['front_shiny'],
                'back_shiny' => $data['sprites']['back_shiny'],
                'official_artwork' => $data['sprites']['other']['official-artwork']['front_default'] ?? $data['sprites']['front_default']
            ],
            'abilities' => array_map(function($ability) {
                return [
                    'name' => $ability['ability']['name'],
                    'is_hidden' => $ability['is_hidden']
                ];
            }, $data['abilities'])
        ];
    }
}