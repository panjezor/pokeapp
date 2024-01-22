<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\PokemonResource\Pages;
use App\Models\Pokemon;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PokemonResource extends Resource
{
    protected static ?string $model = Pokemon::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name'),
                TextInput::make('link')->url(),
                TextInput::make('species'),
                TextInput::make('height')->formatStateUsing(fn (?string $state) => intval($state) / 10 .'m'),
                TextInput::make('weight')->formatStateUsing(fn (?string $state) => intval($state) / 10 .'kg'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->formatStateUsing(fn (string $state) => ucfirst($state))
                    ->searchable(),
            ])
            ->searchOnBlur()
            ->searchDebounce('1302000ms') // a hack so that it doesnt update the filter automatically, only on enter
            ->actions([
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPokemon::route('/'),
            'view' => Pages\ViewPokemon::route('/{record}'),
        ];
    }
}
