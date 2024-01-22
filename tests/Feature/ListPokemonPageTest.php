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
}
