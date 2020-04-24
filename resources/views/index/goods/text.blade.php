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
<center><h1>展示</h1></center>
<form>
    <th width="70">名称:</th>
    <!--查询关键词-->
    <td><input type="text" name="goods_name" value="{{$goods_name}}" placeholder="请输入名称"></td>
    <td><input type="submit" name="sub" value="查询"></td>
</form>
<table class="table table-hover">
    <thead>
    <tr>
        <th>id</th>
        <th>名称</th>
        <th>价格</th>
        <th>数量</th>
        <th>图片</th>
        <th>是否展示</th>
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
        <td><img src="{{env('UPLOADS_URL')}}{{$v->goods_img}}" alt="" width="100"></td>
        <td>{{$v->is_show == '1' ?'是':'否'}}</td>
        <td>sh</td>
    </tr>
        @endforeach
    <tr>
        <td colspan="7">
            {{ $goodsInfo->appends(['goods_name'=>$goods_name])->links() }}
        </td>
    </tr>
    </tbody>
</table>

</body>
</html>
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

