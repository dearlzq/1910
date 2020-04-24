{{--        继承--}}
@extends('layouts.shop')
@section('title', '购物车展示')
@section('content')
    <header>
        <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
        <div class="head-mid">
            <h1>购物车</h1>
        </div>
    </header>
    <div class="head-top">
        <img src="/static/index/images/head.jpg" />
    </div><!--head-top/-->
    <table class="shoucangtab">
        <tr>
            <td width="75%"><span class="hui">购物车共有：<strong class="orange">5</strong>件商品</span></td>
            <td width="25%" align="center" style="background:#fff url(/static/index/images/xian.jpg) left center no-repeat;">
                <span class="glyphicon glyphicon-shopping-cart" style="font-size:2rem;color:#666;"></span>
            </td>
        </tr>
    </table>
    @foreach($cart as $v)
        <div class="dingdanlist">
            <table>
                <tr  goods_id="{{$v->goods_id}}" id="cart_tr">
                    <td width="4%"><input type="checkbox" id="cart_tr" goods_id = {{$v->goods_id}} class="box" name="1" /></td>
                    <td class="dingimg" width="15%"><img src="{{env('UPLOADS_URL')}}{{$v->goods_img}}" /></td>
                    <td width="50%">
                        <h3>{{$v->goods_name}}</h3>
                        <time>下单时间:{{date("Y-m-d H:i",$v->addtime)}}</time>
                    </td>
                    <td align="right"><input type="text" class="spinnerExample" /></td>
                </tr>
                <tr>
                    <th colspan="4"><strong class="orange">¥{{$v->goods_price}}</strong></th>
                </tr>
                <!-- <tr>
                 <td width="100%" colspan="4"><a href="javascript:;"><input type="checkbox" name="1" /> 删除</a></td>
                </tr> -->
            </table>
        </div><!--dingdanlist/-->
    @endforeach
    <div class="height1"></div>
    <div class="gwcpiao">
        <table>
            <tr>
                <th width="10%"><a href="javascript:history.back(-1)"><span class="glyphicon glyphicon-menu-left"></span></a></th>
                <td width="50%">总计：<strong class="orange">¥{{$price}}</strong></td>
                <td width="40%"><a href="javascript:void (0)" class="jiesuan">去结算</a></td>
            </tr>
        </table>
    </div><!--gwcpiao/-->
<script>
    $(".jiesuan").click(function(){
        var _this = $(this);
        var box = $(".box:checked");
        if(box.length == 0){
            alert('请选择要结算的商品');
            return false;
        }
        var str = '';
        box.each(function(){
            str += $(this).parents("tr#cart_tr").attr('goods_id')+',';
        });
        str = str.trim();
        str = str.substr(0,str.length-1);
        // console.log(str);
        // return false;
        location.href="/pay/?ids="+str;
        //  location.href="/pay";
    });
</script>

@endsection
