<?php

namespace App\Filament\Resources\TextinfoResource\Pages;

use App\Filament\Resources\TextinfoResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTextinfo extends EditRecord
{
    protected static string $resource = TextinfoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
