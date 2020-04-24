<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use AlibabaCloud\Client\AlibabaCloud;
use AlibabaCloud\Client\Exception\ClientException;
use AlibabaCloud\Client\Exception\ServerException;
use App\Mail\SendCode;
use Illuminate\Support\Facades\Mail;
use App\Users;
use App\Indexadmin;
use Illuminate\Support\Facades\Cookie;//设置cookie


class LoginController extends Controller
{
    //猪
    public function login()
    {
        return view('index.login');

    }

    //登录
    public function dologin(Request $request)
    {
        $post = $request->except('_token');
//        dd($post);
        //判断是邮箱还是手机号
        $adminuser = Indexadmin::where('a_name',$post['name'])->first();
        //如果解密后的密码和form表单传递的密码不一致返回登录页面并提示
//             dd($adminuser);
            if(decrypt($adminuser->a_pwd)!=$post['password']){
                return redirect('/login')->with('msg','用户或密码错误');
            }
            session(['adminuser'=>$adminuser]);
            if($post['refer']) {
                return redirect($post['refer']);
            }
            return redirect('/');
    }
    //注册页面
    public function register()
    {
        return view('index.register');
    }

    //啊啊啊执行注册啊
    public function regs(){
        $posts = request()->except(['_token','repassword','code']);
//        $codes =  session('code');
        $res = [
            'a_name' => $posts['name'],
            'a_pwd' => encrypt($posts['user_pwd']),
            'a_create' => time()
        ];
        $ret = Indexadmin::insert($res);
//        dd($ret);
        session('code',null);
        if($ret){
            return redirect('/login');
        }
        return redirect('/reg')->with('msg','注册失败');
    }

    //手机号
    public function sendTel(Request $request)
    {
        //接收值
        $name = $request->name;
        //php验证
        $reg = '/^1[3|5|6|7|8|9]\d{9}$/';
//        dd(preg_match($reg,$name));
        if (!preg_match($reg, $name)) {
            echo json_encode(['code' => '11', 'msg' => '手机号格式不正确']);
            exit;
        }
        //发送
        $code = rand(100000, 999999);
        $res = $this->sendByNum($name, $code);
//        dd($res);
        if ($res['Message'] == 'OK') {
            session('code', $code);
            echo json_encode(['code' => '00', 'msg' => '发送成功']);
            exit;

        }
    }

    //测试
    public function sendByNum($name, $code)
    {
// Download：https://github.com/aliyun/openapi-sdk-php
// Usage：https://github.com/aliyun/openapi-sdk-php/blob/master/README.md

        AlibabaCloud::accessKeyClient('LTAI4GBZAB7YYHyxeTn1Mfrf', 'jEg5tzrpGnIfUbyPkhSGH2LghkFZCn')
            ->regionId('cn-hangzhou')
            ->asDefaultClient();

        try {
            $result = AlibabaCloud::rpc()
                ->product('Dysmsapi')
                // ->scheme('https') // https | http
                ->version('2017-05-25')
                ->action('SendSms')
                ->method('POST')
                ->host('dysmsapi.aliyuncs.com')
                ->options([
                    'query' => [
                        'RegionId' => "cn-hangzhou",
                        'PhoneNumbers' => "$name",
                        'SignName' => "可乐加冰",
                        'TemplateCode' => "SMS_182675096",
                        'TemplateParam' => "{code:$code}",
                    ],
                ])
                ->request();
            return ($result->toArray());
        } catch (ClientException $e) {
            return $e->getErrorMessage() . PHP_EOL;
        } catch (ServerException $e) {
            return $e->getErrorMessage() . PHP_EOL;
        }

    }

    //邮箱验证
    public function sendEmail(Request $request)
    {
        //接收值
        $email = $request->email;
        //php验证
        $reg = '/^\w+@[a-z0-9]{2,}\.com$/';
//        dd(preg_match($reg,$email));
        if (!preg_match($reg, $email)) {
            echo json_encode(['code' => '11', 'msg' => '邮箱格式不正确']);
            exit;
        }
        //发送
        $code = rand(100000, 999999);
        $this->sendByEmail($email, $code);
        session(['code' => $code]);
        echo json_encode(['code' => '00', 'msg' => 'f发送成功']);
        exit;
    }

    //测试邮箱
    public function sendByEmail($email, $code)
    {
        Mail::to($email)->send(new SendCode($code));

    }

}
