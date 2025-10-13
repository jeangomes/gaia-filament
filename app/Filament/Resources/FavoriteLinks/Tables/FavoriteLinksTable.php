<?php

namespace App\Filament\Resources\FavoriteLinks\Tables;

use App\Models\FavoriteLink;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class FavoriteLinksTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->recordUrl(null)
            ->columns([
                TextColumn::make('url')
                    ->wrap()
                    ->url(fn (FavoriteLink $record): string => $record->url)
                    ->openUrlInNewTab()
                    ->searchable(),
                TextColumn::make('title')
                    ->label('Título')
                    ->wrap()
                    ->searchable(),
                TextColumn::make('category')
                    ->label('Categoria')
                    ->searchable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
