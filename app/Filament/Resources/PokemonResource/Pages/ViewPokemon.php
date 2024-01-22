<?php

declare(strict_types=1);

namespace App\Filament\Resources\PokemonResource\Pages;

use App\Filament\Resources\PokemonResource;
use Filament\Resources\Pages\ViewRecord;

class ViewPokemon extends ViewRecord
{
    protected static string $resource = PokemonResource::class;

    protected function getHeaderActions(): array
    {
        return [
        ];
    }
}
