<?php

namespace App\Filament\Resources\Purchases\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class PurchaseInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('store'),
                TextEntry::make('purchased_at')
                    ->dateTime(),
                TextEntry::make('paid_at')
                    ->dateTime(),
                TextEntry::make('amount')
                    ->numeric(),
                TextEntry::make('nfce_key_access')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('tax')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
