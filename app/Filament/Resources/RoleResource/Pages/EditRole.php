<?php

namespace App\Filament\Resources\RoleResource\Pages;

use App\Filament\Resources\RoleResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Notifications\Notification;
use Spatie\Permission\Models\Role;

class EditRole extends EditRecord
{
    protected static string $resource = RoleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
            ->before(function (Role $record, Actions\DeleteAction $action) {
                if ($record->name == 'admin' or $record->name == 'user') {
                    Notification::make()
                    ->danger()
                    ->title('You can\'t delete Default Roles!')
                    ->persistent()
                    ->send();
                    $action->cancel();
                }
            }),
        ];
    }
}
