<?php

declare(strict_types=1);

namespace Modules\User\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

// use Laravel\Sanctum\HasApiTokens;
use Modules\Xot\Datas\XotData;
use Laravel\Passport\HasApiTokens;
use Filament\Models\Contracts\HasAvatar;
use Illuminate\Notifications\Notifiable;
use ArtMin96\FilamentJet\Traits\HasTeams;
use Filament\Models\Contracts\FilamentUser;
use ArtMin96\FilamentJet\Traits\HasProfilePhoto;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Spatie\PersonalDataExport\ExportsPersonalData;
// use Laravel\Fortify\TwoFactorAuthenticatable;
// use Laravel\Jetstream\HasProfilePhoto;
// use Laravel\Jetstream\HasTeams;

use ArtMin96\FilamentJet\Contracts\HasTeamsContract;
use ArtMin96\FilamentJet\Traits\CanExportPersonalData;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use ArtMin96\FilamentJet\Traits\TwoFactorAuthenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable implements
    FilamentUser,
    \Modules\Xot\Contracts\UserContract,
    HasAvatar,
    ExportsPersonalData { /* , HasTeamsContract */
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

    public function hasModule(string $name):bool {
        /*
        $models=Module::get();
        $modules=app('modules')->getByStatus(1);
        foreach($modules as $mod){
            $row=Module::firstOrCreate(['name'=>$mod->getName(),'name_low'=>$mod->getLowerName()]);
            $this->modules()->attach($row);
        }
        module non puo' essere sushi per il belongstomany
        */
        $res=$this->modules()->firstWhere('name_low',$name);
        return is_object($res);
    }

    public function modules():BelongsToMany{
        return $this->belongsToMany(Module::class);
    }
    
}
