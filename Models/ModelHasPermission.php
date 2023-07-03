<?php

declare(strict_types=1);

namespace Modules\User\Models;

class ModelHasPermission extends BaseMorphPivot
{
    protected $fillable = ['permission_id', 'model_type', 'model_id'];
}