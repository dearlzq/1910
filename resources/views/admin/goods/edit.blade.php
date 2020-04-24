<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>商品添加</title>
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

<center><h2>商品的添加</h2></center>
<form role="form" method="post" enctype="multipart/form-data" action="{{url('/goods/update/'.$res->goods_id)}}">
    @csrf
    <div class="form-group">
        <label for="name">商品名称</label>
        <input type="text" class="form-control" value="{{$res->goods_name}}" name="goods_name" id="name"
               placeholder="请输入商品名称">
        <b style="color: red">{{$errors->first('goods_name')}}</b>
    </div>
    <div class="form-group">
        <label for="inputfile">商品主图</label>
        <input type="file" id="inputfile" name="goods_img">
        <td><img src="{{env('UPLOADS_URL')}}{{$res->goods_img}}" alt="" width="100"></td>
    </div>
    <div class="form-group">
        <label for="name">商品货号</label>
        <input type="text" class="form-control" value="{{$res->goods_no}}" name="goods_no" id="name"
               placeholder="请输入商品货号">
    </div>

    <div class="form-group">
        <label for="name">商品品牌</label>
        <select name="brand_id" id="">
            <option value="0">--请选择--</option>
            @foreach($brandInfo as $v)
                <option value="{{$v->b_id}}" {{$res->brand_id == $v->b_id ? 'selected' :''}}>{{$v->b_name}}</option>
            @endforeach
        </select>
        <b style="color: red">{{$errors->first('b_id')}}</b>
    </div>

    <div class="form-group">
        <label for="name">商品价格</label>
        <input type="text" class="form-control" value="{{$res->goods_price}}" name="goods_price" id="name"
               placeholder="请输入商品价格">
        <b style="color: red">{{$errors->first('goods_price')}}</b>
    </div>
    <div class="form-group">
        <label for="name">商品库存</label>
        <input type="text" class="form-control" value="{{$res->goods_num}}" name="goods_num" id="name"
               placeholder="请输入商品库存">
        <b style="color: red">{{$errors->first('goods_num')}}</b>
    </div>
    <div class="form-group">
        <label for="inputfile">商品相册</label>
        <input type="file" id="inputfile" name="goods_imgs[]" multiple="multiple">
        <td><img src="{{env('UPLOADS_URL')}}{{$res->goods_imgs}}" alt="" width="100"></td>
    </div>
    <div class="form-group">
        <label for="name">品牌分类</label>
        <select name="cate_id" id="">
            <option value="0">--请输入--</option>
            @foreach($cateInfo as $v)
                <option value="{{$v->cate_id}}" {{$res->cate_id == $v->cate_id ? 'selected' :''}}>{{str_repeat('——|',$v->level)}}{{$v->cate_name}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="name">商品详情</label>
        <textarea  type="text" name="goods_intro" id="name"
                   placeholder="尽情的评价吧~~~">{{$res->goods_intro}}</textarea>
    </div>
    <div class="form-group">
        <label for="name">商品是否显示</label>
        <input type="radio" name="is_show" id="name" value="1" {{$res->is_show == 1 ?'checked' :''}}>显示
        <input type="radio" name="is_show" id="name" value="2">不显示
    </div>
    <div class="form-group">
        <label for="name">是否新品</label>
        <input type="radio" name="is_new" id="name" value="1" {{$res->is_new == 1 ?'checked' :''}}>新品
        <input type="radio" name="is_new" id="name" value="2">非新品
    </div>
    <div class="form-group">
        <label for="name">是否精品</label>
        <input type="radio" name="is_best" id="name" value="1" {{$res->is_best == 1 ?'checked' :''}}>精品
        <input type="radio" name="is_best" id="name" value="2">非精品
    </div>

    <button type="submit" class="btn btn-default">提交</button>
</form>

</body>
</html>
<a href="{{url('goods')}}" class="btn btn-link">展示</a>

