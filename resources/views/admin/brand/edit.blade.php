<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>品牌管理编辑</title>
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
                    <a href="{{url('/admins')}}">
                        管理员品牌></b>
                    </a>

                </li>
            </ul>
        </div>
    </div>
</nav>

<center><h2>品牌编辑</h2></center>
<form class="form-horizontal" action="{{url('/brand/update/'.$brand->b_id)}}" method="post" role="form" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">品牌名称</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="b_name" value="{{$brand->b_name}}" id="firstname" placeholder="请输入名字">
        </div>
    </div>
    <div class="form-group">
        <label for="lastname" class="col-sm-2 control-label">品牌网址</label>
        <div class="col-sm-10">
            <input type="text" class="form-control"  value="{{$brand->b_url}}" name="b_url" id="lastname" placeholder="请输入网址">
        </div>
    </div>
    <div class="form-group">
        <label for="lastname" class="col-sm-2 control-label">品牌LOGO</label>
        <div class="col-sm-10">
            <input type="file" class="form-control" name="b_logo" id="lastname" placeholder="请输入LOGO">
            <td><img src="{{env('UPLOADS_URL')}}{{$brand->b_logo}}" alt="" width="100"></td>
        </div>
    </div>
    <div class="form-group">
        <label for="lastname" class="col-sm-2 control-label">品牌描述</label>
        <div class="col-sm-10">
            <textarea type="text" class="form-control" name="b_intro" id="lastname" placeholder="请输入描述">{{$brand->b_intro}}</textarea>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-default">编辑</button>
        </div>
    </div>
</form>
</body>
</html>

<a href="{{url('brand')}}" class="btn btn-link">展示</a>
