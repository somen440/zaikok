<?php

namespace Zaikok;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class InventoryGroup extends Model
{
    /** @var array  */
    protected $guarded = [];

    /**
     * @param Builder $builder
     * @param int     $userId
     * @return Builder
     */
    public function scopeFindLastByUserId(
        Builder $builder,
        int $userId
    ): Builder {
        return $builder
            ->where('user_id', $userId)
            ->orderBy('inventory_group_id', 'desc')
            ->limit(1);
    }
}
