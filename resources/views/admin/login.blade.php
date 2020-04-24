<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>微商城登录</title>
    <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<center><h2>微商城登录</h2></center>
<form role="form" method="post" action="{{url('/login/logindo')}}">
    @csrf
    <div class="form-group">
        <label for="name">用户名</label>
        <input type="text" class="form-control" name="a_name" id="name"
               placeholder="请输入用户名">
    </div>

    <div class="form-group">
        <label for="name">密码</label>
        <input type="text" class="form-control" name="a_pwd" id="name"
               placeholder="请输入密码">
    </div>
    <div class="form-group">
        <label for="name">是否记住密码7天</label>
        <input type="radio" name="is_check" id="name">
    </div>


    <button type="submit" class="btn btn-default">登录</button>
</form>

</body>
</html>

