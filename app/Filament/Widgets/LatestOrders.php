<?php

namespace App\Filament\Widgets;

use App\Models\Purchase;
use Filament\Actions\BulkActionGroup;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;

class LatestOrders extends TableWidget
{
    protected static ?int $sort = 3;
    protected static ?string $heading = 'Compras recentes';
    public function table(Table $table): Table
    {
        return $table
            ->query(fn (): Builder => Purchase::query()->limit('5')->orderByDesc('purchased_at'))
            ->columns([
                TextColumn::make('store')->label('Local')
                    ->searchable(),
                TextColumn::make('purchased_at')->label('Data')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('amount')->label('Valor')
                    ->money('BRL')
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->paginated(false)
            ->filters([
                //
            ])
            ->headerActions([
                //
            ])
            ->recordActions([
                //
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    //
                ]),
            ]);
    }
}
