<?php

namespace App\Filament\Resources\FavoriteLinks;

use App\Filament\Resources\FavoriteLinks\Pages\CreateFavoriteLink;
use App\Filament\Resources\FavoriteLinks\Pages\EditFavoriteLink;
use App\Filament\Resources\FavoriteLinks\Pages\ListFavoriteLinks;
use App\Filament\Resources\FavoriteLinks\Schemas\FavoriteLinkForm;
use App\Filament\Resources\FavoriteLinks\Tables\FavoriteLinksTable;
use App\Models\FavoriteLink;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class FavoriteLinkResource extends Resource
{
    protected static ?string $model = FavoriteLink::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'title';
    protected static ?string $modelLabel = 'link';

    public static function form(Schema $schema): Schema
    {
        return FavoriteLinkForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return FavoriteLinksTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListFavoriteLinks::route('/'),
            'create' => CreateFavoriteLink::route('/create'),
            'edit' => EditFavoriteLink::route('/{record}/edit'),
        ];
    }
}
