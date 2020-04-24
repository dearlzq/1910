<?php
namespace App\Http\Controllers\Index;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Goods;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;

class IndexController extends Controller
{
    //主图
    public function index()
    {
        //幻灯片主图
//        $goodsInfo = Cache::get('slide');//获取它
//        dump($goodsInfo);
        $goodsInfo = Redis::get('slide');
//        $goodsInfo = cache('slide');
//        dump($goodsInfo);
        if(!$goodsInfo) {//如果没有的话，从数据库读取
            $goodsInfo = Goods::getGoodsInfo();
//            Cache::put('slide',$goodsInfo,60);//时间为一分钟
            $goodsInfo = serialize($goodsInfo);//进行序列化
            Redis::setex('slide',60,$goodsInfo);
            //使用辅助函数
//            cache(['slide'=>$goodsInfo],60);
        }
        $goodsInfo = unserialize($goodsInfo);//进行反序列化
        return view('index.index',['goodsInfo'=>$goodsInfo]);
    }
}
