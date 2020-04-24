<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>品牌管理添加</title>
    <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<nav class="navbar navbar-inverse" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">友情链接系列</a>
        </div>
        <div>
            <ul class="nav navbar-nav">
                <li class="active"><a href="{{'/brand'}}">商品品牌</a></li>
                <li><a href="{{'/cate'}}">品牌分类</a></li>
                <li><a href="{{url('/goods')}}">商品</a></li>
                <li class="dropdown">
                    <a href="{{url('/admins')}}">
                        管理员品牌></b>
                    </a>

                </li>
                <li class="dropdown">
                    <a href="{{url('/firends')}}">
                        友情链接></b>
                    </a>

                </li>
            </ul>
        </div>
    </div>
</nav>

<center><h2>友情链接添加</h2></center>
{{--显示错误信息在页面上-- top}}--}}
{{--@if ($errors->any())--}}
{{--    <div class="alert alert-danger">--}}
{{--        <ul>@foreach ($errors->all() as $error)--}}
{{--                <li>{{ $error }}</li>--}}
{{--            @endforeach--}}
{{--        </ul>--}}
{{--    </div>--}}
{{--@endif--}}
{{--end--}}
<form class="form-horizontal" action="{{url('/firends/store')}}" method="post" role="form" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">网站名称</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="f_name" id="firstname" placeholder="请输入名字">
            <b style="color: red">{{$errors->first('f_name')}}</b>
        </div>
    </div>
    <div class="form-group">
        <label for="lastname" class="col-sm-2 control-label">友情网址</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="f_url" id="lastname" placeholder="请输入网址">
            <b style="color: red">{{$errors->first('f_url')}}</b>
        </div>
    </div>
    <div class="form-group">
        <label for="lastname" class="col-sm-2 control-label">链接类型</label>
        <div class="col-sm-10">
            <input type="radio" name="f_status" id="lastname" value="1" checked>LOGO链接
            <input type="radio" name="f_status" id="lastname" value="2">文字链接
        </div>
    </div>
    <div class="form-group">
        <label for="lastname" class="col-sm-2 control-label">图片LOGO</label>
        <div class="col-sm-10">
            <input type="file" class="form-control" name="f_img" id="lastname" placeholder="请输入LOGO">
        </div>
    </div>
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">网站联系人</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="f_pre" id="firstname" placeholder="请输入名字">
        </div>
    </div>
    <div class="form-group">
        <label for="lastname" class="col-sm-2 control-label">网站介绍</label>
        <div class="col-sm-10">
            <textarea type="text" class="form-control" name="f_intro" id="lastname" placeholder="请输入描述"></textarea>
        </div>
    </div>
    <div class="form-group">
        <label for="lastname" class="col-sm-2 control-label">是否显示</label>
        <div class="col-sm-10">
            <input type="radio" name="f_show" id="lastname" value="1">是
            <input type="radio" name="f_show" id="lastname" value="2">否
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-default">添加</button>
        </div>
    </div>
</form>
</body>
</html>

<a href="{{url('firends')}}" class="btn btn-link">展示</a>

