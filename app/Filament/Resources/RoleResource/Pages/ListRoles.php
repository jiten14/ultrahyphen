<?php

namespace App\Filament\Resources\RoleResource\Pages;

use Closure;
use Illuminate\Database\Eloquent\Model;
use App\Filament\Resources\RoleResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRoles extends ListRecords
{
    protected static string $resource = RoleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function isTableRecordSelectable(): ?Closure
    {
        return fn (Model $record): bool => $record->status === Status::Enabled;
    }

}
