<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    //
    public function index()
    {
        return view('index',['name'=>'keke']);
    }

    public function do_add()
    {
        //打印所有的数据Request()->all();
        //dd打印 ，相当于dump,die;
       $post = Request()->all();
        dd($post);
    }

    public function goods($name,$id)
    {
        echo $name;
        echo $id;
    }


}
