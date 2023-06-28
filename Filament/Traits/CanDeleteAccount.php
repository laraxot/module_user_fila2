<?php

namespace Modules\User\Filament\Traits;

use Modules\User\Contracts\DeletesUsers;
use Filament\Facades\Filament;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;

trait CanDeleteAccount
{
    /**
     * Delete the current user.
     *
     * @param  Request  $request
     * @param  DeletesUsers  $deleter
     */
    public function deleteAccount(Request $request, DeletesUsers $deleter): Redirector|RedirectResponse
    {
        $deleter->delete(Auth::user()->fresh());

        Filament::auth()->logout();

        if ($request->hasSession()) {
            $request->session()->invalidate();
            $request->session()->regenerateToken();
        }

        return redirect(config('filament.path'));
    }
}
