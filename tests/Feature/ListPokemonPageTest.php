<?php

declare(strict_types=1);

class ListPokemonPageTest extends \Tests\TestCase
{
    /**
     * @test
     */
    public function can_see_a_full_list_of_available_pokemon()
    {
        $this->actingAs(\App\Models\User::factory()->create());
        $pokemon = \App\Models\Pokemon::factory(10)->create();
        $livewire = \Livewire\Livewire::test(\App\Filament\Resources\PokemonResource\Pages\ListPokemon::class);
        $livewire->assertCanSeeTableRecords($pokemon);
    }

    /**
     * @test
     */
    public function can_search_with_the_filter()
    {
        $this->actingAs(\App\Models\User::factory()->create());
        $pokemon = \App\Models\Pokemon::factory(100)->create();
        $lastPokemon = $pokemon->last();
        $livewire = \Livewire\Livewire::test(\App\Filament\Resources\PokemonResource\Pages\ListPokemon::class);
        $livewire->assertCanNotSeeTableRecords([$lastPokemon]);
        $livewire->searchTable($lastPokemon->name)->assertCanSeeTableRecords([$lastPokemon]);
    }
}
