{{--        继承--}}
@extends('layouts.shop')
@section('title', $res->goods_name)
@section('content')
    <header>
        <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
        <div class="head-mid">
            <h1>产品详情</h1>
        </div>
    </header>
    <div id="sliderA" class="slider">
        @if($res->goods_imgs)
            @php $goods_imgs = explode('|',$res->goods_imgs) @endphp
            @foreach($goods_imgs as $vv)
                <img src="{{env('UPLOADS_URL')}}{{$vv}}" width="100" alt="">
            @endforeach
        @endif
{{--        <img src="{{env('UPLOADS_URL')}}{{$res->goods_img}}" />--}}
    </div><!--sliderA/-->
    <table class="jia-len">
        <tr>
            <th><strong class="orange">{{$res->goods_price}}</strong></th>
            <td>
                <input type="text" id="buy_number" class="spinnerExample" />
            </td>
        </tr>
        <tr>
            <td>
                <strong>{{$res->goods_name}}</strong>
                <p class="hui">{{$res->goods_intro}}</p>
                <p class="hui">当前页面访问量：{{$visit}}</p>
            </td>
            <td align="right">
                <a href="javascript:;" class="shoucang"><span class="glyphicon glyphicon-star-empty"></span></a>
            </td>
        </tr>
    </table>
    <div class="height2"></div>
    <h3 class="proTitle">商品规格</h3>
    <ul class="guige">
        <li class="guigeCur"><a href="javascript:;">50ML</a></li>
        <li><a href="javascript:;">100ML</a></li>
        <li><a href="javascript:;">150ML</a></li>
        <li><a href="javascript:;">200ML</a></li>
        <li><a href="javascript:;">300ML</a></li>
        <div class="clearfix"></div>
    </ul><!--guige/-->
    <div class="height2"></div>
    <div class="zhaieq">
        <a href="javascript:;" class="zhaiCur">商品简介</a>
        <a href="javascript:;">商品参数</a>
        <a href="javascript:;" style="background:none;">订购列表</a>
        <div class="clearfix"></div>
    </div><!--zhaieq/-->
    <div class="proinfoList">
        <img src="/static/index/images/image4.jpg" width="636" height="822" />
    </div><!--proinfoList/-->
    <div class="proinfoList">
        暂无信息....
    </div><!--proinfoList/-->
    <div class="proinfoList">
        暂无信息......
    </div><!--proinfoList/-->
    <table class="jrgwc">
        <tr>
            <th>
                <a href="index.html"><span class="glyphicon glyphicon-home"></span></a>
            </th>
            <td><a id="addcar" href="#">加入购物车</a></td>
        </tr>
    </table>
</div><!--maincont-->
    <script>
        $('#addcar').click(function () {
            var goods_id = {{$res->goods_id}};
            var buy_num = $('#buy_number').val();
            // alert(goods_id);
            // alert(buy_num);
            $.get('/addcar',{goods_id:goods_id,buy_num:buy_num},function (res) {
                if(res.code == '11') {
                    location.href = "/login?refer="+window.location.href;
                }
                if(res.code =='00') {
                    alert(res.msg);
                    location.href = "/cartlist";
                }
            },'json');
        })
    </script>
    @include('index.public.footer');
@endsection
