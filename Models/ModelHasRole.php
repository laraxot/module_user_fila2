<?php

declare(strict_types=1);

namespace Modules\User\Models;

class ModelHasRole extends BaseMorphPivot
{
    /**
     * @var array<string>
     *
     * @psalm-var list{'role_id', 'model_type', 'model_id'}
     */
    protected $fillable = ['role_id', 'model_type', 'model_id'];
}
