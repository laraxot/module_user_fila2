<?php

namespace Modules\User\Models;

namespace Modules\User\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ModuleUser extends Pivot
{
    /**
     * @var string
     */
    protected $connection = 'mysql'; // this will use the specified database connection
}
