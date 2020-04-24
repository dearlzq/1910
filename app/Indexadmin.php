<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Indexadmin extends Model
{
    //
    //指定表名
    protected $table = 'indexadmin';
    //指定主键
    protected $primaryKey = 'a_id';
    //关闭时间戳
    public $timestamps = false;
    //黑名单
    protected $guarded = [];
}
