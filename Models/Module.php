<?php

declare(strict_types=1);

namespace Modules\User\Models;

use Sushi\Sushi;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Nwidart\Modules\Facades\Module as NwModule;

class Module extends BaseModel
{
    protected $fillable=['name','name_low'];
}
