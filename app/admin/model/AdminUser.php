<?php
/**
 * Func :
 * Create By Lpb
 * Date: 2021/2/3 0003
 * Time: 11:58
 */

namespace app\admin\model;

use support\Model;

class AdminUser extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'admin_user';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;
}