<?php

declare(strict_types=1);

namespace Modules\User\Models;

use Laravel\Passport\RefreshToken as PassportRefreshToken;

/**
 * Modules\User\Models\OauthRefreshToken.
 *
 * @property string                                     $id
 * @property string                                     $access_token_id
 * @property bool                                       $revoked
 * @property \Illuminate\Support\Carbon|null            $expires_at
 * @property \Modules\User\Models\OauthAccessToken|null $accessToken
 *
 * @method static \Illuminate\Database\Eloquent\Builder|OauthRefreshToken newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OauthRefreshToken newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OauthRefreshToken query()
 * @method static \Illuminate\Database\Eloquent\Builder|OauthRefreshToken whereAccessTokenId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OauthRefreshToken whereExpiresAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OauthRefreshToken whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OauthRefreshToken whereRevoked($value)
 *
<<<<<<< HEAD
 * @mixin IdeHelperOauthRefreshToken
=======
>>>>>>> 1903df6 (up)
 * @mixin \Eloquent
 */
class OauthRefreshToken extends PassportRefreshToken
{
    /*
     * @var string
     */
<<<<<<< HEAD
    protected $connection = 'user';
=======
    protected $connection = 'mysql';
>>>>>>> 1903df6 (up)
    // protected $fillable = ['id', 'access_token_id', 'revoked', 'expires_at'];
}
