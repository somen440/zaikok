<?php

namespace Zaikok;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class LineVerify extends Model
{
    /** @var array  */
    protected $fillable = ['line_id', 'user_id'];

    /**
     * @param Builder $builder
     * @param mixed   $lineId
     * @return Builder
     */
    public function scopeFindByLineId(Builder $builder, string $lineId): Builder
    {
        return $builder->where('line_id', $lineId)->limit(1);
    }
}
