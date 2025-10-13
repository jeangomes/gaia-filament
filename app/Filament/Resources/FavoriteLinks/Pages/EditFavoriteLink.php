<?php

namespace App\Filament\Resources\FavoriteLinks\Pages;

use App\Filament\Resources\FavoriteLinks\FavoriteLinkResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditFavoriteLink extends EditRecord
{
    protected static string $resource = FavoriteLinkResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
