<?php

namespace Modules\User\Models\Traits;

use Modules\User\Models\User;

trait IsProfileTrait {
    // --- RELATIONS
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}