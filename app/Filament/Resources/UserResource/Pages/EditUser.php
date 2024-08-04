<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Notifications\Notification;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
            ->before(function (User $record, Actions\DeleteAction $action) {
                if ($record->name == Auth::user()->name) {
                    Notification::make()
                    ->danger()
                    ->title('You can\'t delete self account!')
                    ->persistent()
                    ->send();
                    $action->cancel();
                }
            }),
        ];
    }
}
