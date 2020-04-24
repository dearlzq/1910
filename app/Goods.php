<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Goods extends Model
{
    //指定表名
    protected $table = 'goods';
    //指定主键
    protected $primaryKey = 'goods_id';
    //关闭时间戳
    public $timestamps = false;
    //黑名单
    protected $guarded = [];
    //是否幻灯片主图
    public static function getGoodsInfo()
    {
        return self::select('goods_id','goods_img')->where('is_slide',1)->take(5)->get();

    }
}
