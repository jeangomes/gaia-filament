<?php

namespace App\Filament\Resources\Purchases\Schemas;

use App\Models\Purchase;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class PurchaseForm
{
    public static function configure(Schema $schema): Schema
    {
        $stores = Purchase::query()->select('store')
            ->distinct()
            ->orderBy('store')
            ->pluck('store');

        return $schema
            ->components([
                TextInput::make('store')
                    ->required()
                    ->datalist($stores->toArray())
                    ->maxLength(200),
                DateTimePicker::make('purchased_at')
                    ->required(),
                TextInput::make('amount')
                    ->required()
                    ->numeric(),
                Textarea::make('nfce_key_access')
                    ->columnSpanFull(),
                TextInput::make('tax')
                    ->numeric(),
            ]);
    }
}
