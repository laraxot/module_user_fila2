<<<<<<< HEAD
<?php

declare(strict_types=1);

namespace Modules\User\Datas;

use Spatie\LaravelData\Data;

/**
 * Undocumented class.
 */
class SuperAdminData extends Data
{
    public bool $enabled; // ' => true,
    public string $name; // ' => 'super_admin',
    public bool $define_via_gate; // ' => false,
    public string $intercept_gate; // ' => 'before', // after
}
=======
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
class SuperAdminData extends Data
{
    public bool $enabled;//' => true,
    public string $name;//' => 'super_admin',
    public bool $define_via_gate;//' => false,
    public string $intercept_gate;//' => 'before', // after
}
>>>>>>> d1783f5 (up)
