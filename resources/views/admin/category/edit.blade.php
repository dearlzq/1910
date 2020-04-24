<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Bootstrap 实例 - 基本表单</title>
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

<center><h2>品牌分类</h2></center>
<form role="form" method="post" action="{{url('/cate/update/'.$res->goods_id)}}">
    @csrf
    <div class="form-group">
        <label for="name">品牌分类名称</label>
        <input type="text" class="form-control" value="{{$res->cate_name}}" name="cate_name" id="name"
               placeholder="请输入分类名称">
    </div>
    <div class="form-group">
        <label for="name">品牌分类</label>
        <select name="pid" id="">
            <option value="">--请输入--</option>
            @foreach($re as $v)
                <option value="{{$v->cate_id}}" {{$res->cate_id == $v->cate_id ? 'selected' :''}}>{{str_repeat('——|',$v->level)}}{{$v->cate_name}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="name">品牌分类名称</label>
        <textarea type="text" name="cate_intro" value="{{$res->cate_intro}}" id="name"
                  placeholder="请输入分类名称">{{$res->cate_name}}</textarea>
    </div>
    <div class="checkbox">
        <label>
            <input type="radio" name="is_show_nav" value="1" {{$res->is_show_nav == 1 ?'checked' :''}}>展示在导航栏
            <input type="radio" name="is_show_nav" value="2">不展示在导航栏
        </label>
    </div>
    <button type="submit" class="btn btn-default">编辑</button>
</form>

</body>
</html>

<a href="{{url('cate')}}" class="btn btn-link">展示</a>
