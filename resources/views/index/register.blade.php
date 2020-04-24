{{--        继承--}}
@extends('layouts.shop')
{{--标题--}}
@section('title', '注册')
@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <header>
        <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
        <div class="head-mid">
            <h1>会员注册</h1>
        </div>
    </header>
    <div class="head-top">
        <img src="/static/index/images/head.jpg" />
    </div><!--head-top/-->
    <form action="{{url('/regs')}}" method="post" class="reg-login">
        @csrf
        @if( session('msg'))
            <div class="alert alert-danger">{{session('msg')}}</div>
        @endif
        <h3>已经有账号了？点此<a class="orange" href="{{url('/login')}}">登陆</a></h3>
        <div class="lrBox">
            <div class="lrList"><input type="text" name="name" placeholder="输入手机号码或者邮箱号" />
            <span></span></div>
            <div class="lrList2"><input type="text" name="code" placeholder="输入短信验证码" /><span></span>
                <button type="button">获取验证码</button></div>
            <div class="lrList"><input type="text" name="user_pwd" placeholder="设置新密码（6-18位数字或字母）" />
                <span></span></div>
            <div class="lrList"><input type="text" name="repassword" placeholder="再次输入密码" />
                <span></span></div>
        </div><!--lrBox/-->
        <div class="lrSub">
            <input type="submit"class="btn-reg" value="立即注册" />
        </div>
    </form><!--reg-login/-->

    <script>
        $('button').click(function () {
            var name = $('input[name=name]').val();
            var reg = /^1[3|5|6|7|8|9]\d{9}$/;
            if(reg.test(name)){
                //防止csrf
                $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
                //手机号发送验证码
                $.post('/sendTel',{name:name},function (res) {
                    alert(res.msg);
                },'json');
                return;
            }
            //邮箱的正则
            var preg = /^\w+@[a-z0-9]{2,}\.com$/;

            if(preg.test(name)) {
                $.get('/sendEmail',{email:name},function (resa) {
                    alert(resa.msg);
                },'json');
                return;
            }
            alert('请输入正确的手机号或者邮箱');
        });
        $(".btn-reg").click(function(){
            var flag = false;
            var xhr = /^1[3|5|6|7|8|9]\d{9}$/;
            var name = $('input[name="name"]').val();
            if(name==''){
                $('input[name="name"]+span').html("<font color='red'>手机号码或邮箱不能为空</font>");
                flag = false;
            }else if(!xhr.test(name)){
                $('input[name="name"]+span').html("<font color='red'>格式不正确</font>");
                flag = false;
            }else{
                $('input[name="name"]+span').html();
                flag = true;
            }

            var aflag = false;
            var code = $('input[name="code"]').val();
            if(code == ''){
                $('input[name="code"]+span').html("<font color='red'>验证码不能为空</font>");
                aflag = false;
            }else{
                $('input[name="code"]+span').html();
                aflag = true;
            }


            var bflag = false;
            var user_pwd = $('input[name="user_pwd"]').val();
            if(user_pwd == ''){
                $('input[name="user_pwd"]+span').html("<font color='red'>密码不能为空</font>");
                bflag = false;
            }else{
                $('input[name="user_pwd"]+span').html();
                bflag = true;

            }

            var cflag = false;
            var repassword = $('input[name="repassword"]').val();
            if(repassword ==''){
                $('input[name="repassword"]+span').html("<font color='red'>确认密码不能为空</font>");
                cflag = false;
            }else if(password != repassword){
                $('input[name="repassword"]+span').html("<font color='red'>密码和确认密码保持一致</font>");
                cflag = false;
            }else{
                $('input[name="repassword"]+span').html();
                cflag = true;
            }

            if(flag === false || aflag === false || bflag === false || cflag === false){
                return false;
            }
            $('form').submit();
        });
    </script>

    @include('index.public.footer');
@endsection

