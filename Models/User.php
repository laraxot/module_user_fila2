<?php

declare(strict_types=1);

namespace Modules\User\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

// use Laravel\Sanctum\HasApiTokens;
use ArtMin96\FilamentJet\Contracts\UserContract as UserJetContract;
use ArtMin96\FilamentJet\Traits\CanExportPersonalData;
use ArtMin96\FilamentJet\Traits\HasProfilePhoto;
use ArtMin96\FilamentJet\Traits\HasTeams;
use ArtMin96\FilamentJet\Traits\TwoFactorAuthenticatable;
use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasAvatar;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
// use Laravel\Fortify\TwoFactorAuthenticatable;
// use Laravel\Jetstream\HasProfilePhoto;
// use Laravel\Jetstream\HasTeams;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Modules\Xot\Datas\XotData;
use Spatie\Permission\Traits\HasRoles;
use Spatie\PersonalDataExport\ExportsPersonalData;

/**
 * Modules\User\Models\User.
 *
 * @property int                                                                                                           $id
 * @property string                                                                                                        $name
 * @property string                                                                                                        $email
 * @property string                                                                                                        $api_token
 * @property \Illuminate\Support\Carbon|null                                                                               $email_verified_at
 * @property string                                                                                                        $password
 * @property string|null                                                                                                   $two_factor_secret
 * @property string|null                                                                                                   $two_factor_recovery_codes
 * @property string|null                                                                                                   $two_factor_confirmed_at
 * @property string|null                                                                                                   $remember_token
 * @property int|null                                                                                                      $current_team_id
 * @property string|null                                                                                                   $profile_photo_path
 * @property \Illuminate\Support\Carbon|null                                                                               $created_at
 * @property \Illuminate\Support\Carbon|null                                                                               $updated_at
 * @property \Illuminate\Database\Eloquent\Collection<int, \Laravel\Passport\Client>                                       $clients
 * @property int|null                                                                                                      $clients_count
 * @property string                                                                                                        $profile_photo_url
 * @property \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property int|null                                                                                                      $notifications_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \Spatie\Permission\Models\Permission>                           $permissions
 * @property int|null                                                                                                      $permissions_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \Spatie\Permission\Models\Role>                                 $roles
 * @property int|null                                                                                                      $roles_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \Laravel\Passport\Token>                                        $tokens
 * @property int|null                                                                                                      $tokens_count
 *
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User permission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User role($roles, $guard = null)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCurrentTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereProfilePhotoPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTwoFactorConfirmedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTwoFactorRecoveryCodes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTwoFactorSecret($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 *
 * @mixin IdeHelperUser
 *
 * @property string|null $lang
 * @property int|null    $owned_teams_count
 * @property int|null    $teams_count
 *
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLang($value)
 *
 * @mixin \Eloquent
 */
class User extends Authenticatable implements
    FilamentUser,
    \Modules\Xot\Contracts\UserContract,
    HasAvatar,
    UserJetContract,
    ExportsPersonalData { /* , HasTeamsContract */
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use HasTeams;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use CanExportPersonalData;
    use HasRoles;

    /**
     * @var string
     */
    protected $connection = 'user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'lang',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        // 'password' => 'hashed', //Call to undefined cast [hashed] on column [password] in model [Modules\User\Models\User].
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function canAccessFilament(): bool {
        // return $this->role_id === Role::ROLE_ADMINISTRATOR;
        return true;
    }

    public function profile(): HasOne {
        $profileClass = XotData::make()->getProfileClass();

        return $this->hasOne($profileClass);
    }
}
