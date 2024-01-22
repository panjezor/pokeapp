<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Pokemon;
use Illuminate\Support\Facades\Http;

class PokeAPIService
{
    public function pullAll()
    {
        // there is a couple ways of doing that, but the requirement says "Given I am on a main pokedex page - When the page loads - I can see a full list"
        $response = Http::get('https://pokeapi.co/api/v2/pokemon?limit=1200000');
        if (! $response->ok()) {
            throw new \Exception('Check why this would error out');
            // production-ready would handle that gracefully and redirect
        }
        if ($response->json('count') < 1) {
            throw new \Exception('We got a 200 status code but 0 pokemon');
        }
        $pokedata = $response->json()['results'];

        foreach ($pokedata as $pokedatum) {
            Pokemon::query()->firstOrCreate(['name' => $pokedatum['name']], ['link' => $pokedatum['url']]);
        }
    }

    public function verifyRecord(int|string $record)
    {
        $pokemon = Pokemon::query()->find($record);
        $response = Http::get("https://pokeapi.co/api/v2/pokemon/$pokemon->name");
        // TODO: response validator
        $json = $response->json();
        $pokemon->fill([
            'abilities' => array_map(fn (array $row) => $row['ability']['name'], $json['abilities']),
            'height' => $json['height'],
            'weight' => $json['weight'],
            'species' => $json['species']['name'],
            'image' => $json['sprites']['front_default'],
        ]);
        $pokemon->save();
    }
}
