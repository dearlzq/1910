<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\CartModel;
use App\Goods;
use Illuminate\Support\Facades\Cache;


class CartController extends Controller
{
    //购物车展示
    public function cartlist()
    {
        $user_id = session('adminuser')->a_id;
//        dd($user_id);
        $cart = \DB::select("select * , buy_num*goods_price as price from cart where user_id = ?",[$user_id]);
//        dd($cart);
        //每个商品的购买数量
        $buy_num = array_column($cart,'buy_num');
//        dd($buy_num);
        //购物车的id
        $cart_id = array_column($cart,'cart_id');
        $checkBuyNum = array_combine($cart_id,$buy_num);
        //总价格
        $totalPrice = array_sum(array_column($cart,'price'));
//        dd($totalPrice);
        return view('index.goods.cartlist',['cart'=>$cart,'checkBuyNum'=>$checkBuyNum,'price'=>$totalPrice]);
    }
    //去结算
    public function pay(request $request)
    {
        $goods_ids = $request->ids;
//        dd($goods_ids);
        $goods_id = explode(',',$goods_ids);//分割
//        dd($goods_id);16
        $goods = Goods::whereIn('goods_id',$goods_id)->get();//查出来
//        dd($goods);
        return view('index.goods.pay',['goods'=>$goods,'goods_id'=>$goods_id]);
    }
    //提交订单
    public function success($id){
        $goods_id = $id;
        dd($goods_id);
        // $user_id = cookie('user_id');

        $user_id = 18;
        $order_no = rand(1000,9999).time();
        $order_id = $id;

        $data = [
            'user_id'=>$user_id,
            'create_time'=>time(),
            'order_no'=>$order_no
        ];
        $ret = Order::create($data);
        dd($ret);
        if($ret){

            return view('index.success',['order_no'=>$order_id]);
        }
    }
    //测试
    public function text()
    {
        $page = request()->page??1;
        //搜索
//        dump($page);
        $goods_name = request()->goods_name??'';
//        dump($goods_name);
        $goodsInfo = Cache::get('brand_'.$page.'_'.$goods_name);
//        dump($goodsInfo);
        if(!$goodsInfo) {
//            echo '数据库中获取';
            $where = [];
            if($goods_name) {
                $where[] = ['goods_name','like',"%$goods_name%"];
            }
            $pagesize = config('app.pageSize');
            $goodsInfo = Goods::where($where)->paginate($pagesize);
            Cache::put('brand_'.$page.'_'.$goods_name,$goodsInfo,3);
        }
        if(request()->ajax()) {
            return view('index.goods.ajax',['goodsInfo'=>$goodsInfo,'goods_name'=>$goods_name]);
        }
        return view('index.goods.text',['goodsInfo'=>$goodsInfo,'goods_name'=>$goods_name]);
    }
}
