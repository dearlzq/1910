<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Firends extends Model
{
    //
    //指定表名
    protected $table = 'firends';
    //指定主键
    protected $primaryKey = 'f_id';
    //关闭时间戳
    public $timestamps = false;
    //黑名单
    protected $guarded = [];
}
