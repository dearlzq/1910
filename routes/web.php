<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//
//Route::get('/', function () {
//    return view('welcome');
//});

//走控制器的方法
Route::get('/index','IndexController@index');
//Route::view('/index','index');
Route::post('/do_add/{name}/{sex}','IndexController@do_add')->where(['name'=>'[a-z]+','sex'=>'[0-9]+']);
//必填参数
Route::get('bitian/{name}',function ($name){
    return $name;
})->where(['name'=>'[a-z]+']);

Route::get('goodst/{name}/{id}','IndexController@goods');
//可选参数
Route::get('user/{name?}', function ($name = null) {
    return $name;
});
//正则
Route::get('users/{id}/{name}', function ($id, $name) {
    // 同时指定 id 和 name 的数据格式
    return "{$id}.{$name}";
})->where(['id' => '[0-9]+', 'name' => '[a-z]+']);











//admin
Route::domain('admin.lavavel.com')->group(function (){
    //商品品牌管理
        Route::prefix('/brand')->middleware('auth')->group(function (){
            Route::get('create','Admin\BrandController@create');//添加
            Route::post('store','Admin\BrandController@store');//执行添加
            Route::get('/','Admin\BrandController@index');//展示
            Route::get('destroy/{id}','Admin\BrandController@destroy');//删除
            Route::get('edit/{id}','Admin\BrandController@edit');//编辑
            Route::post('update/{id}','Admin\BrandController@update');//执行编辑
        });
    //商品的分类
        Route::prefix('/cate')->middleware('auth')->group(function (){
            Route::get('create','Admin\CategoryController@create');//添加
            Route::post('store','Admin\CategoryController@store');//执行添加
            Route::get('/','Admin\CategoryController@index');//展示
            Route::get('destroy/{id}','Admin\CategoryController@destroy');//删除
            Route::get('edit/{id}','Admin\CategoryController@edit');//编辑
            Route::post('update/{id}','Admin\CategoryController@update');//执行编辑
        });
    //商品
        Route::prefix('/goods')->middleware('auth')->group(function (){
            Route::get('create','Admin\GoodsController@create');//添加
            Route::post('store','Admin\GoodsController@store');//执行添加
            Route::get('/','Admin\GoodsController@index');//展示
            Route::get('destroy/{id}','Admin\GoodsController@destroy');//删除
            Route::get('edit/{id}','Admin\GoodsController@edit');//编辑
            Route::post('update/{id}','Admin\GoodsController@update');//执行编辑
        });
    //管理员
        Route::prefix('/admins')->middleware('auth')->group(function (){
            Route::get('create','Admin\AdminController@create');//添加
            Route::post('store','Admin\AdminController@store')->name('adminstore');//执行添加
            Route::get('/','Admin\AdminController@index');//展示
            Route::get('destroy/{id}','Admin\AdminController@destroy');//删除
            Route::get('edit/{id}','Admin\AdminController@edit');//编辑
            Route::post('update/{id}','Admin\AdminController@update')->name('adminupdate');//执行编辑
        });
    //登录
        Route::view('/login','admin.login');
        Route::post('/login/logindo','Admin\LoginController@logindo');//执行登录
    //友情管理链接
        Route::prefix('/firends')->middleware('auth')->group(function (){
            Route::get('create','Admin\FirendsController@create');//添加
            Route::post('store','Admin\FirendsController@store')->name('firendsstore');//执行添加
            Route::get('/','Admin\FirendsController@index');//展示
            Route::get('destroy/{id}','Admin\FirendsController@destroy');//删除
            Route::get('edit/{id}','Admin\FirendsController@edit');//编辑
            Route::post('update/{id}','Admin\FirendsController@update')->name('firendsupdate');//执行编辑
        });
        Auth::routes();

        Route::get('/home', 'HomeController@index')->name('home');
});
//index
Route::domain('www.lavavel.com')->group(function (){
    //登录
    Route::get('/login','Index\LoginController@login');//登录
    Route::post('/doLogin','Index\LoginController@dologin');//执行登录
    Route::get('/register','Index\LoginController@register');//注册
    Route::post('/regs','Index\LoginController@regs');//执行注册
    Route::post('/sendTel','Index\LoginController@sendTel');//手机号发送验证码
    Route::get('/sendEmail','Index\LoginController@sendEmail');//邮箱发送验证

    //首页
    Route::get('/','Index\IndexController@index')->name('shop.index');//首页
    Route::get('/goods/{id}','Index\GoodsController@goodsInfo')->name('shop.goods');//商品详情
    Route::get('/addcar','Index\GoodsController@addcar');//购物车
    Route::get('/cartlist','Index\CartController@cartlist')->name('shop.cartlist');//购物展示
    Route::get('/pay','Index\CartController@pay');//去结算
    Route::get('/success/{id}','Index\CartController@success');//提交订单


//    //结算
//    Route::get('/pay','Index\GoodsController@pay');
    Route::get('/text','Index\CartController@text');//提交订单




});

