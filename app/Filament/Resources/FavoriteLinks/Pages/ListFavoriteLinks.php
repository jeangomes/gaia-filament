<?php

namespace App\Filament\Resources\FavoriteLinks\Pages;

use App\Filament\Resources\FavoriteLinks\FavoriteLinkResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListFavoriteLinks extends ListRecords
{
    protected static string $resource = FavoriteLinkResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
