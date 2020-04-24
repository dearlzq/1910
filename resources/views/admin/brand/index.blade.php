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
            </ul>
        </div>
    </div>
</nav>



<center><h2>品牌展示</h2></center>
<form>
            <th width="70">品牌名称:</th>
            <!--查询关键词-->
            <td><input type="text" name="b_name" value="{{$b_name}}" placeholder="品牌名称"></td>
            <td><input type="submit" name="sub" value="查询"></td>
</form>
<table class="table table-hover">
    <thead>
    <tr>
        <th>品牌id</th>
        <th>品牌名称</th>
        <th>网址</th>
        <th>品牌图片</th>
        <th>介绍</th>
        <th>操作</th>
    </tr>
    </thead>

    <tbody>
    @foreach($brandList as $v)
    <tr>
        <td>{{$v->b_id}}</td>
        <td>{{$v->b_name}}</td>
        <td>{{$v->b_url}}</td>
        <td><img src="{{env('UPLOADS_URL')}}{{$v->b_logo}}" alt="" width="100"></td>
        <td>{{$v->b_intro}}</td>
        <td>
            <a href="{{url('/brand/destroy/'.$v->b_id)}}" class="btn btn-danger">删除</a>
            <a href="{{url('/brand/edit/'.$v->b_id)}}" class="btn btn-primary">编辑</a>
        </td>
    </tr>
    @endforeach
    <tr>
        <td colspan="6">
            {{ $brandList->appends(['b_name' => $b_name])->links() }}
        </td>
    </tr>
    </tbody>


</table>

</body>
</html>
<a href="{{url('brand/create')}}" class="btn btn-link">添加</a>
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
