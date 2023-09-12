<?php

declare(strict_types=1);

namespace Modules\User\Models;

use ArtMin96\FilamentJet\Models\Team as FilamentJetTeam;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Carbon;

/**
 * Modules\User\Models\Team.
 *
 * @property int                   $id
 * @property int                   $user_id
 * @property string                $name
 * @property bool                  $personal_team
 * @property Carbon|null           $created_at
 * @property Carbon|null           $updated_at
 * @property User|null             $owner
 * @property Collection<int, User> $users
 * @property int|null              $users_count
 *
 * @method static Builder|Team newModelQuery()
 * @method static Builder|Team newQuery()
 * @method static Builder|Team query()
 * @method static Builder|Team whereCreatedAt($value)
 * @method static Builder|Team whereId($value)
 * @method static Builder|Team whereName($value)
 * @method static Builder|Team wherePersonalTeam($value)
 * @method static Builder|Team whereUpdatedAt($value)
 * @method static Builder|Team whereUserId($value)
 *
 * @mixin IdeHelperTeam
 *
 * @property Collection<int, TeamInvitation> $teamInvitations
 * @property int|null                        $team_invitations_count
 *
 * @mixin \Eloquent
 */
class Team extends FilamentJetTeam
{
    use HasFactory;

    /**
     * @var string
     */
    protected $connection = 'user';
}
