<?php

declare(strict_types=1);

namespace Modules\User\Filament\Actions;

use Filament\Forms;
use Filament\Pages\Actions\Action;

class AlwaysAskPasswordConfirmationAction extends Action
{
    protected function setUp(): void
    {
        $this->requiresConfirmation()
            ->modalHeading(__('filament-jet::jet.password_confirmation_modal.heading'))
            ->modalSubheading(
                __('filament-jet::jet.password_confirmation_modal.description')
            )
            ->form([
                Forms\Components\TextInput::make('current_password')
                    ->label(__('filament-jet::jet.password_confirmation_modal.current_password'))
                    ->required()
                    ->password()
                    ->rule('current_password'),
            ]);
    }
}
