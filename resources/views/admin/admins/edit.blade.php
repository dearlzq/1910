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
            <a class="navbar-brand" href="#">品牌系列</a>
        </div>
        <div>
            <ul class="nav navbar-nav">
                <li class="active"><a href="{{'/brand'}}">商品品牌</a></li>
                <li><a href="{{'/cate'}}">品牌分类</a></li>
                <li><a href="{{url('/goods')}}">商品</a></li>
                <li class="dropdown">
                    <a href="{{url('/admins')}}" class="dropdown-toggle" data-toggle="dropdown">
                        管理员品牌 <b class="caret"></b>
                    </a>

                </li>
            </ul>
        </div>
    </div>
</nav>

<center><h2>管理员修改</h2></center>
{{--显示错误信息在页面上-- top}}--}}
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>@foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
{{--end--}}
<form class="form-horizontal" action="{{url('/admins/update/'.$res->a_id)}}" method="post" role="form">
    @csrf
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">管理员名称</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="a_name" value="{{$res->a_name}}" id="firstname" placeholder="请输入管理员名称">
            <b style="color: red">{{$errors->first('a_name')}}</b>
        </div>
    </div>
    <div class="form-group">
        <label for="lastname" class="col-sm-2 control-label">手机号</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" value="{{$res->a_tel}}" name="a_tel" id="lastname" placeholder="手机号">
            <b style="color: red">{{$errors->first('a_tel')}}</b>
        </div>
    </div>
    <div class="form-group">
        <label for="lastname" class="col-sm-2 control-label">邮箱</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" value="{{$res->a_email}}" name="a_email" id="lastname" placeholder="邮箱">
            <b style="color: red">{{$errors->first('a_email')}}</b>
        </div>
    </div>
    <div class="form-group">
        <label for="lastname" class="col-sm-2 control-label">密码</label>
        <div class="col-sm-10">
            <input type="password" class="form-control" value="{{decrypt($res->a_pwd)}}" name="a_pwd" id="lastname" placeholder="密码">
            <b style="color: red">{{$errors->first('a_pwd')}}</b>
        </div>
    </div>
    <div class="form-group">
        <label for="lastname" class="col-sm-2 control-label">确认密码</label>
        <div class="col-sm-10">
            <input type="password" class="form-control" value="{{decrypt($res->a_pwd)}}" name="a_ewpwd" id="lastname" placeholder="密码">
            <b style="color: red">{{$errors->first('a_ewpwd')}}</b>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-default">修改</button>
        </div>
    </div>
</form>
</body>
</html>

<a href="{{url('admins')}}" class="btn btn-link">展示</a>

