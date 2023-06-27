<?php

namespace Modules\User\Http\Livewire\Traits\Properties;

use Modules\User\FilamentJet;

trait HasSanctumPermissionsProperty
{
    public function getSanctumPermissionsProperty()
    {
        return collect(FilamentJet::$permissions)
            ->mapWithKeys(function ($permission) {
                return [$permission => $permission];
            });
    }
}
