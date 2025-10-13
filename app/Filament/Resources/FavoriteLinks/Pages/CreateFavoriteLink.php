<?php

namespace App\Filament\Resources\FavoriteLinks\Pages;

use App\Filament\Resources\FavoriteLinks\FavoriteLinkResource;
use Filament\Resources\Pages\CreateRecord;

class CreateFavoriteLink extends CreateRecord
{
    protected static string $resource = FavoriteLinkResource::class;
}
