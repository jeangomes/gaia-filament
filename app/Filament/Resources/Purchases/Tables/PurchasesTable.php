<?php

namespace App\Filament\Resources\Purchases\Tables;

use App\Models\Purchase;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use IntlDateFormatter;

class PurchasesTable
{
    public static function configure(Table $table): Table
    {
        $formatador = new IntlDateFormatter(
            'pt_BR',
            IntlDateFormatter::FULL,
            IntlDateFormatter::FULL,
            'America/Sao_Paulo',
            IntlDateFormatter::GREGORIAN,
            'E, dd \'de\' MMM \'de\' yyyy, HH:mm'
        );
        return $table
            ->columns([
                TextColumn::make('purchased_at')
                    ->label('Data')
                    //->dateTime('l jS \o\f F Y h:i:s A')
                    ->state(function (Purchase $record) use ($formatador) {
                        return $formatador->format($record->purchased_at);
                    })
                    ->sortable(),
                TextColumn::make('store')
                    ->label('Local')
                    ->searchable(),
                TextColumn::make('amount')
                    ->label('Valor Total')
                    ->money('BRL')
                    ->sortable(),
                TextColumn::make('tax')
                    ->label('Imposto')
                    ->money('BRL')
                    ->sortable(),
                TextColumn::make('items_count')
                    ->counts('items')
                    ->label('Total de Items'),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('id', 'desc')
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
