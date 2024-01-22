<?php

declare(strict_types=1);

use App\Filament\Resources\PokemonResource\Pages\ListPokemon;
use App\Models\Pokemon;
use App\Models\User;
use Livewire\Livewire;
use Tests\TestCase;

class ListPokemonPageTest extends TestCase
{
    /**
     * @test
     */
    public function can_see_a_full_list_of_available_pokemon()
    {
        $this->actingAs(User::factory()->create());
        $pokemon = Pokemon::factory(10)->create();
        $livewire = Livewire::test(ListPokemon::class);
        $livewire->assertCanSeeTableRecords($pokemon);
    }

    /**
     * @test
     */
    public function can_search_with_the_filter()
    {
        $this->actingAs(User::factory()->create());
        $pokemon = Pokemon::factory(100)->create();
        $lastPokemon = $pokemon->last();
        $livewire = Livewire::test(ListPokemon::class);
        $livewire->assertCanNotSeeTableRecords([$lastPokemon]);
        $livewire->searchTable($lastPokemon->name)->assertCanSeeTableRecords([$lastPokemon]);
    }
}
