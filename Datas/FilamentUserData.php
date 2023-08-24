<?php

declare(strict_types=1);

namespace Modules\User\Datas;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Spatie\LaravelData\Data;
use Webmozart\Assert\Assert;

/**
 * Undocumented class.
 */
class FilamentUserData extends Data
{
    public bool $enabled;// => true,
    public string $name; // => 'filament_user',
}
