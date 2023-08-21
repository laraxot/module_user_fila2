<<<<<<< HEAD
<<<<<<< HEAD
<?php

declare(strict_types=1);

namespace Modules\User\Datas;

use Spatie\LaravelData\Data;

/**
 * Undocumented class.
 */
class ShieldResourceData extends Data
{
    public int $navigation_sort; // = -1;
    public bool $navigation_badge; // = true;
    public bool $navigation_group; // = true;
    public bool $is_globally_searchable; // = false;
}
=======
=======
>>>>>>> c3ef5a0 (up)
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


    public int $navigation_sort;// = -1;
    public bool $navigation_badge;// = true;
    public bool $navigation_group;// = true;
    public bool $is_globally_searchable;// = false;

}
<<<<<<< HEAD
>>>>>>> d1783f5 (up)
=======
>>>>>>> c3ef5a0 (up)
