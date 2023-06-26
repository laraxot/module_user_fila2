<?php

namespace Modules\User\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Modules\Xot\Datas\XotData;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Filament\Models\Contracts\FilamentUser;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Filament\Models\Contracts\HasAvatar;
use Spatie\PersonalDataExport\ExportsPersonalData;
//use Laravel\Fortify\TwoFactorAuthenticatable;
//use Laravel\Jetstream\HasProfilePhoto;
//use Laravel\Jetstream\HasTeams;

use ArtMin96\FilamentJet\Traits\CanExportPersonalData;
use ArtMin96\FilamentJet\Traits\HasProfilePhoto;
use ArtMin96\FilamentJet\Traits\HasTeams;
use ArtMin96\FilamentJet\Traits\TwoFactorAuthenticatable;
use ArtMin96\FilamentJet\Contracts\HasTeamsContract;

class User extends Authenticatable implements FilamentUser, \Modules\Xot\Contracts\UserContract, HasAvatar, ExportsPersonalData, HasTeamsContract
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use HasTeams;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use CanExportPersonalData;



    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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
        'password' => 'hashed',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function canAccessFilament(): bool
    {
        //return $this->role_id === Role::ROLE_ADMINISTRATOR;
        return true;
    }

    public function profile(): HasOne
    {
        $profileClass=XotData::make()->getProfileClass();
        return $this->hasOne($profileClass);
    }



}
