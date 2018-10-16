<?php

namespace Zaikok;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    public const PLUS = 1;
    public const MINUS = 2;

    public const TYPE_STRING_MAP = [
        self::PLUS => '加算',
        self::MINUS => '減算',
    ];

    /** @var array  */
    protected $guarded = [];

    public function scopeLastInventoryId(Builder $query, int $group): Builder
    {
        return $query->where('inventory_group_id', $group)->orderBy('inventory_id', 'asc')->limit(1);
    }
}
