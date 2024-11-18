<?php

namespace App\Filament\Resources\TipoCambioResource\Pages;

use App\Filament\Resources\TipoCambioResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTipoCambios extends ListRecords
{
    protected static string $resource = TipoCambioResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
