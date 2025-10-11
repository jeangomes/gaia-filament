<?php

namespace App\Filament\Resources\Purchases\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class PurchaseForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('store')
                    ->required(),
                DateTimePicker::make('purchased_at')
                    ->required(),
                DateTimePicker::make('paid_at')
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
