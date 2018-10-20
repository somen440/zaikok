<?php

namespace Zaikok;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use Notifiable;

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'bearer_token',
    ];

    /**
     * @var string
     */
    protected $primaryKey = 'user_id';

    /**
     * @var array
     */
    protected $guarded = [
        'bearer_token',
    ];

    /**
     * @param Builder $builder
     * @param string  $token
     * @return Builder
     */
    public function scopeFindByLineVerifyToken(Builder $builder, string $token): Builder
    {
        return $builder->where('line_verify_token', $token);
    }
}
