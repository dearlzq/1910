<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>友情链接展示</title>
    <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<nav class="navbar navbar-inverse" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">友情系列</a>
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

<center><h2>友情链接展示</h2></center>
<form>
    <th width="70">网址名称:</th>
    <!--查询关键词-->
    <td><input type="text" name="f_name" value="{{$f_name}}" placeholder="网址名称"></td>
    <td><input type="submit" name="sub" value="查询"></td>
</form>
<table class="table table-hover">
    <thead>
    <tr>
        <th>友情链接id</th>
        <th>链接名称</th>
        <th>友情网址</th>
        <th>友情链接图片</th>
        <th>链接类型</th>
        <th>网站联系人</th>
        <th>网站介绍</th>
        <th>是否显示</th>
        <th>操作</th>
    </tr>
    </thead>

    <tbody>
    @foreach($firendsInfo as $v)

        <tr>
            <td>{{$v->f_id}}</td>
            <td>{{$v->f_name}}</td>
            <td>{{$v->f_url}}</td>
            <td><img src="{{env('UPLOADS_URL')}}{{$v->f_img}}" alt="" width="100"></td>
            <td>{{$v->f_status == '1'?'LOGO链接' :'文字链接'}}</td>
            <td>{{$v->f_pre}}</td>
            <td>{{$v->f_intro}}</td>
            <td>{{$v->f_show == '1'?'是' :'否'}}</td>
            <td>
                <a href="javascript:void (0)" id="del" data_id="{{$v->f_id}}" class="btn btn-danger">删除</a>
                <a href="{{url('/firends/edit/'.$v->f_id)}}" class="btn btn-primary">编辑</a>
            </td>
        </tr>
    @endforeach
    <tr>
        <td colspan="9">
            {{$firendsInfo->appends(['f_name'=>$f_name])->links()}}
        </td>
    </tr>
    </tbody>
</table>

</body>
</html>
<a href="{{url('firends/create')}}" class="btn btn-link">添加</a>
<script>
    //ajax删除
    $(document).on('click','#del',function () {
        var _this = $(this);
        var id = _this.attr('data_id');
        if(confirm('确认删除???') == true){
            $.get('/firends/destroy/'+id,function (res) {
                if(res.error_no == 0){
                    _this.parents("tr").remove();
                } else {
                    alert('res.error_msg');
                }
            },'json')
        }
    });
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
