<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use DemeterChain\C;
use Illuminate\Http\Request;
use App\Goods;
use App\CartModel;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;

class GoodsController extends Controller
{
    //商品详情页面
    public function goodsInfo($id)
    {
        $visit = Redis::setnx('visit_'.$id,1)?1:Redis::incr('viait_'.$id);
        $res = Goods::find($id);
        return view('index.goods.goodsinfo',['res'=>$res,'visit'=>$visit]);
   }

   //加入购物车
    /*
     *判断用户是否登录，未登录跳到登录页面，登录 后返回此商品的首页
     *
     * 登录：
     *     1，判断商品库存是否大于购买数量，如果小于提示库存不足
     *     2，判断用户是否有此商品的信息，有的话就相加，判断商品库存是否大于购买数量，如果小于提示库存不足，
     * */
    public function addcar()
    {
        $goods_id = request()->goods_id;
        $buy_num = request()->buy_num;
        $user = 4;
        if(!$user) {
            showMsg('11','未登录，请先登录');
        }
        $goods = Goods::select('goods_id','goods_name','goods_img','goods_price','goods_num')->find($goods_id);
//        dd($goods);
        if($goods->goods_num < $buy_num) {
            showMsg('11','库存不足啦偶');
        }
        $where = [
            'user_id' =>1,
            'goods_id' =>$goods_id
        ];
        $cart = CartModel::where($where)->first();
//        dd($cart);
        if($cart) {
            //更新购买数量
            $buy_num = $cart->buy_num + $buy_num;
            if($goods->goods_num < $buy_num) {
                $buy_num = $goods->goods_num;
            }
            $res = CartModel::where('cart_id',$cart->cart_id)->update(['buy_num'=>$buy_num]);
//            dd($res);
        } else {
            //添加购物车
            $data = [
                'user_id' =>1,
                'buy_num' =>$buy_num,
                'addtime' =>time()
            ];
            $data = array_merge($data,$goods->toArray());
            unset($data['goods_num']);
            $res = CartModel::create($data);
        }
        if($res !== false) {
            showMsg('00','添加购物车成功');
        }
    }

    //结算
    public function pay()
    {
        return view('index.goods.pay');
    }


}
