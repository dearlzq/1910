<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>品牌展示</title>
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
                <li><a href="{{url('/cate')}}">商品分类</a></li>
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



<center><h2>管理员展示</h2></center>
<table class="table table-hover">
    <thead>
    <tr>
        <th>管理员id</th>
        <th>管理员名称</th>
        <th>管理员手机号</th>
        <th>管理员邮箱</th>
        <th>添加时间</th>
        <th>操作</th>
    </tr>
    </thead>
    @foreach($adminInfo as $v)
        <tbody>
        <tr>
            <td>{{$v->a_id}}</td>
            <td>{{$v->a_name}}</td>
            <td>{{$v->a_tel}}</td>
            <td>{{$v->a_email}}</td>
            <td>{{date('Y-m-d H:i:s',$v->a_create)}}</td>
            <td>
                <a href="{{url('/admins/destroy/'.$v->a_id)}}" class="btn btn-danger">删除</a>
                <a href="{{url('/admins/edit/'.$v->a_id)}}" class="btn btn-primary">编辑</a>
            </td>
        </tr>
        </tbody>
    @endforeach
    <tr>

    </tr>
</table>

</body>
</html>
<a href="{{url('admins/create')}}" class="btn btn-link">添加</a>

