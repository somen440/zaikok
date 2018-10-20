<?php

namespace Zaikok;

use Illuminate\Database\Eloquent\Model;

class InventoryControlLog extends Model
{
    /**
     * @var int ログタイプ
     */
    public const TYPE_ADD = 1;
    public const TYPE_DELETE = 2;
    public const TYPE_UPDATE = 3;

    /** @var array  */
    protected $guarded = [];
}
