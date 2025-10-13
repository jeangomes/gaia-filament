<?php

namespace App\Filament\Resources\FavoriteLinks\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class FavoriteLinkForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('url')
                    ->url()
                    ->required(),
                TextInput::make('title')->label('Título'),
                Textarea::make('description')
                    ->label('Descrição')
                    ->columnSpanFull(),
                TextInput::make('category')->label('Categoria'),
            ]);
    }
}
