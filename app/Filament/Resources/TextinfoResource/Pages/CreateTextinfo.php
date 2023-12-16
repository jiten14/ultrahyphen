<?php

namespace App\Filament\Resources\TextinfoResource\Pages;

use App\Filament\Resources\TextinfoResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateTextinfo extends CreateRecord
{
    protected static string $resource = TextinfoResource::class;

    protected static bool $canCreateAnother = false;
}
