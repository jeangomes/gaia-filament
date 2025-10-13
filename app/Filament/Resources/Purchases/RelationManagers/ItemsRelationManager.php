<?php

namespace App\Filament\Resources\Purchases\RelationManagers;

use App\Models\PurchaseItem;
use Filament\Actions\AssociateAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DissociateAction;
use Filament\Actions\DissociateBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\TextInput;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ItemsRelationManager extends RelationManager
{
    protected static string $relationship = 'items';
    protected static ?string $label = 'Items';

    public function form(Schema $schema): Schema
    {
        $items = PurchaseItem::query()->select('product_name')
            ->distinct()
            ->orderBy('product_name')
            ->pluck('product_name');
        return $schema
            ->components([
                TextInput::make('product_name')
                    ->label('Produto')
                    ->datalist($items->toArray())
                    ->required(),
                TextInput::make('product_code')
                    ->label('Código')
                    ->default('-')
                    ->required(),
                TextInput::make('quantity')
                    ->label('Quantidade')
                    ->required()
                    ->default(1)
                    ->numeric()
                    ->inputMode('decimal'),
                TextInput::make('unit_measure')
                    ->label('Unidade de Medida')
                    ->default('-')
                    ->required(),
                TextInput::make('unit_price')
                    ->label('Preço unitário')
                    ->required()
                    ->numeric()
                    ->inputMode('decimal'),
                TextInput::make('total_price')
                    ->label('Valor total')
                    ->required()
                    ->numeric()
                    ->inputMode('decimal'),
            ]);
    }

    public function infolist(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('product_name'),
                TextEntry::make('product_code'),
                TextEntry::make('quantity')
                    ->numeric(),
                TextEntry::make('unit_measure'),
                TextEntry::make('unit_price')
                    ->numeric(),
                TextEntry::make('total_price')
                    ->numeric(),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('product_name')
            ->columns([
                TextColumn::make('product_name')->label('Nome')
                    ->searchable(),
                TextColumn::make('product_code')->label('Código')
                    ->searchable(),
                TextColumn::make('quantity')->label('Quantidade')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('unit_measure')->label('Unidade')
                    ->searchable(),
                TextColumn::make('unit_price')->label('Valor unitário')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('total_price')->label('Valor total')
                    ->numeric()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                CreateAction::make()
                    ->mutateDataUsing(function (array $data): array {
                        $data['product_name'] = strtoupper($data['product_name']);

                        return $data;
                    }),
                //AssociateAction::make(),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make()
                    ->mutateDataUsing(function (array $data): array {
                        $data['product_name'] = strtoupper($data['product_name']);

                        return $data;
                    }),
                //DissociateAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    //DissociateBulkAction::make(),
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
