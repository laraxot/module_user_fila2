<<<<<<< HEAD
<<<<<<< HEAD
<?php

declare(strict_types=1);

namespace Modules\User\Http\Livewire\Traits\Properties;

use Filament\Facades\Filament;
use Illuminate\Contracts\Auth\Authenticatable;

trait HasUserProperty
{
    /**
     * Get the current user of the application.
     */
    public function getUserProperty(): ?Authenticatable
    {
        return Filament::auth()->user();
    }
}
=======
=======
>>>>>>> c3ef5a0 (up)
<?php

namespace Modules\User\Http\Livewire\Traits\Properties;

use Filament\Facades\Filament;
use Illuminate\Contracts\Auth\Authenticatable;

trait HasUserProperty
{
    /**
     * Get the current user of the application.
     */
    public function getUserProperty(): ?Authenticatable
    {
        return Filament::auth()->user();
    }
}
<<<<<<< HEAD
>>>>>>> d1783f5 (up)
=======
>>>>>>> c3ef5a0 (up)
