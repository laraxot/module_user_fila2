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
class ShieldResourceData extends Data
{
    public bool $should_register_navigation;//= true;
    public string $slug;// = 'shield/roles';
    public int $navigation_sort;// = -1;
    public bool $navigation_badge;// = true;
    public bool $navigation_group;// = true;
    public bool $is_globally_searchable;// = false;
    public bool $show_model_path;// = true;
}
