<?php

namespace App\Filament\Resources\Purchases\Tables;

use App\Models\Purchase;
use Carbon\Carbon;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PurchasesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('purchased_at')
                    ->label('Data')
                    ->formatStateUsing(function ($state) {
                        return Carbon::parse($state)
                            ->locale('pt_BR')
                            ->translatedFormat('D, d \d\e M. \d\e Y, H:i');
                    })
                    ->sortable(),
                TextColumn::make('store')
                    ->label('Local')
                    ->searchable(),
                TextColumn::make('amount')
                    ->label('Valor Total')
                    ->money('BRL')
                    ->sortable(),
                TextColumn::make('items_sum_total_price')
                    ->label('Soma Items')
                    ->sum('items', 'total_price')
                    ->money('BRL'),
                TextColumn::make('tax')
                    ->label('Imposto')
                    ->money('BRL')
                    ->sortable(),
                TextColumn::make('items_count')
                    ->counts('items')
                    ->label('Qtd de Items'),
                TextColumn::make('created_at')
                    ->dateTime('d/m/Y H:i')->timezone('America/Sao_Paulo')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('purchased_at', 'desc')
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
