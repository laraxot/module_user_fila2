<?php

declare(strict_types=1);

namespace Modules\User\Filament\Resources\UserResource\Pages;

use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Hash;
use Modules\User\Filament\Resources\UserResource;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    public function beforeSave(): void
    {
        if (! array_key_exists('new_password', $this->data) || ! filled($this->data['new_password'])) {
            return;
        }

        $this->record->password = Hash::make($this->data['new_password']);
    }

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
