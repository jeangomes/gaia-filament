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
                TextEntry::make('store')->label('Local'),
                TextEntry::make('purchased_at')->label('Data')
                    ->dateTime(),
                TextEntry::make('amount')
                    ->label('Valor')
                    ->money('BRL'),
                TextEntry::make('tax')
                    ->label('Imposto')
                    ->money('BRL')
                    ->placeholder('-'),
                TextEntry::make('nfce_key_access')->label('NFCE Key')
                    ->placeholder('-'),
                TextEntry::make('created_at')->label('Data de Cadastro')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
