<?php

declare(strict_types=1);

use App\Filament\Resources\PokemonResource\Pages\ViewPokemon;
use App\Models\Pokemon;
use App\Models\User;
use Livewire\Livewire;
use Tests\TestCase;

class ViewPokemonPageTest extends TestCase
{
    /**
     * @test
     */
    public function can_go_back()
    {
        $this->mock(\App\Services\PokeAPIService::class, function (\Mockery\MockInterface $mock){
            $mock->shouldReceive('verifyRecord')->once();
        });

        $this->actingAs(User::factory()->create());
        $collection = Pokemon::factory(1)->create();
        $livewire = Livewire::test(
            ViewPokemon::class,
            ['record' => $collection->first()->id]
        );
        $livewire->assertCanSeeTableRecords($collection);
    }
}
