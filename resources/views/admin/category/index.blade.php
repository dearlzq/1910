<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Bootstrap 实例 - 悬停表格</title>
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
            </ul>
        </div>
    </div>
</nav>

<center><h2>品牌分类展示</h2></center>
<table class="table table-hover">
    <thead>
    <tr>
        <th>分类id</th>
        <th>分类名称</th>
        <th>父级id</th>
        <th>分类描述</th>
        <th>是否展示在导航栏</th>
        <th>操作</th>
    </tr>
    </thead>
    @foreach($cateList as $v)
    <tbody>
    <tr>
        <td>{{$v->cate_id}}</td>
        <td>{{str_repeat('——|',$v->level)}}{{$v->cate_name}}</td>
        <td>{{$v->pid}}</td>
        <td>{{$v->cate_intro}}</td>
        <td>{{$v->is_show_nav == '1' ?'是':'否'}}</td>
        <td>
            <a href="{{url('/cate/destroy/'.$v->cate_id)}}" class="btn btn-danger">删除</a>
            <a href="{{url('/cate/edit/'.$v->cate_id)}}" class="btn btn-primary">编辑</a>
        </td>
    </tr>

    </tbody>
        @endforeach
</table>

</body>
</html>

<a href="{{url('cate/create')}}" class="btn btn-link">添加</a>
