<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use DemeterChain\A;
use Illuminate\Http\Request;
use App\Admin;
//use think\Cookie;
use Illuminate\Support\Facades\Cookie;//设置cookie
class LoginController extends Controller
{
    //
    public function logindo(Request $request)
    {
        $admin = $request->except('_token');
        $adminuser = Admin::where('a_name',$admin['a_name'])->first();
        if(decrypt($adminuser->a_pwd) != $admin['a_pwd']) {
            return redirect('/login')->with('msg','用户名或密码有误');
        }
        //7天免登录    isset判断是否存在值
        if(isset($admin['is_check'])) {
            //存入cookie中
            Cookie::queue('num',$adminuser,24*60*7);
        }

        session(['adminuser'=>$adminuser]);
        return redirect('/goods');
    }
}
