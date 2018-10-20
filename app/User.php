<?php

namespace Zaikok;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
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
     * @param mixed   $lineId
     * @return Builder
     */
    public function scopeFindByLineId(Builder $builder, string $lineId): Builder
    {
        return $builder->where('line_id', $lineId);
    }

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
