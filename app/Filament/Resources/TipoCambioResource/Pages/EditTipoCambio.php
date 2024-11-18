<?php

namespace App\Filament\Resources\TipoCambioResource\Pages;

use App\Filament\Resources\TipoCambioResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTipoCambio extends EditRecord
{
    protected static string $resource = TipoCambioResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
