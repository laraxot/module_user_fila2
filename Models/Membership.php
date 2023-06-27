<?php


declare(strict_types=1);

namespace Modules\User\Models;


use ArtMin96\FilamentJet\Models\Membership as FilamentJetMembership;

class Membership extends FilamentJetMembership
{
    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;
}
