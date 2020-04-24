<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>商品列表展示</title>
    <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<nav class="navbar navbar-inverse" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">品牌系列</a>
        </div>
        <div>
            <ul class="nav navbar-nav">
                <li class="active"><a href="{{url('/brand')}}">商品品牌</a></li>
                <li><a href="{{url('/cate')}}">商品分类</a></li>
                <li><a href="{{url('/goods')}}">商品</a></li>
                <li class="dropdown">
                    <a href="{{url('/admins')}}">
                        管理员品牌></b>
                    </a>

                </li>
            </ul>
        </div>
    </div>
</nav>

<center><h2>商品列表展示</h2></center>
<form action="">
    品牌：<select name="b_name" id="">
        <option value="0">--选择--</option>
        @foreach($brandInfo as $v)
        <option value="{{$v->b_id}}}" @if(isset($query['b_id']) && $v->b_id == $query['b_id']) selected="selected" @endif>{{$v->b_name}}</option>
            @endforeach
    </select>
    商品分类：<select name="cate_name" id="">
        <option value="0">--选择--</option>
        @foreach($cateInfo as $v)
            <option value="{{$v->cate_id}}}" @if(isset($query['cate_id']) && $v->cate_id == $query['cate_id']) selected="selected" @endif>{{str_repeat('——|',$v->level)}}{{$v->cate_name}}</option>
        @endforeach
    </select>
    商品名称：<input type="text" value="{{$query['goods_name']??''}}" name="goods_name" placeholder="请输入商品名称关键字">
    <button>搜索</button>
</form>
<table class="table table-hover">
    <thead>
    <tr>
        <th>商品id</th>
        <th>商品名字</th>
        <th>商品价格</th>
        <th>货号</th>
        <th>商品数量</th>
        <th>商品主图</th>
        <th>相册</th>
        <th>品牌名称</th>
        <th>分类名称</th>
        <th>是否展示</th>
        <th>是否新品</th>
        <th>是否精品</th>
        <th>商品介绍</th>
        <th>操作</th>
    </tr>
    </thead>

    <tbody>
    @foreach($goodsInfo as $v)
    <tr>
        <td>{{$v->goods_id}}</td>
        <td>{{$v->goods_name}}</td>
        <td>{{$v->goods_price}}</td>
        <td>{{$v->goods_no}}</td>
        <td>{{$v->goods_num}}</td>
        <td><img src="{{env('UPLOADS_URL')}}{{$v->goods_img}}" alt="" width="100"></td>
        <td>
            @if($v->goods_imgs)
                @php $goods_imgs = explode('|',$v->goods_imgs) @endphp
                @foreach($goods_imgs as $vv)
                    <img src="{{env('UPLOADS_URL')}}{{$vv}}" width="100" alt="">
                @endforeach
            @endif
        </td>
        <td>{{$v->b_name}}</td>
        <td>{{$v->cate_name}}</td>
        <td>{{$v->is_show == '1' ?'是':'否'}}</td>
        <td>{{$v->is_new == '1' ?'是':'否'}}</td>
        <td>{{$v->is_best == '1' ?'是':'否'}}</td>
        <td>{{$v->goods_intro}}</td>
        <td>
            <a href="{{url('/goods/destroy/'.$v->goods_id)}}" class="btn btn-danger">删除</a>
            <a href="{{url('/goods/edit/'.$v->goods_id)}}" class="btn btn-primary">编辑</a>
        </td>
    </tr>
    @endforeach
    <tr>
        <td colspan="11">
            {{ $goodsInfo->appends($query)->links() }}
        </td>
    </tr>
    </tbody>


</table>

</body>
</html>
<a href="{{url('goods/create')}}" class="btn btn-link">添加</a>
<script>
    $(document).on('click','.page-item a',function() {
        var url =$(this).attr('href');
        // alert(url);
        // return false;
        $.get(url,function(res) {
            $('tbody').html(res);
        });
        return false;
    });
</script>

