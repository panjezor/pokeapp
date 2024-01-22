<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\PokemonResource\Pages;
use App\Models\Pokemon;
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
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // height comes as 0.1m iterations, weight as 0.1kg
                Tables\Columns\TextColumn::make('name')
                    ->formatStateUsing(fn (string $state) => ucfirst($state))
                    ->searchable(),
                Tables\Columns\TextColumn::make('link'),
            ])
            ->searchOnBlur()
            ->searchDebounce('1302000ms') // a hack so that it doesnt update the filter automatically, only on enter
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
