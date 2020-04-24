<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Cate;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $cateList = Cate::get();
        $r = $this->GetcateInfor($cateList);
        return view('admin.category.index',['cateList'=>$r]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $res = Cate::get();
        $r = $this->GetcateInfor($res);
        return view('admin.category.create',['re'=>$r]);
    }
    //无限极分类
    public function GetcateInfor($res , $pid = 0 , $level = 1)
    {
        //使用静态数组，避免递归调用时，多次调用导致覆盖，
        static $infor = [];
        //第一次遍历，找到父节点为根节点的id ，也就是pid 等于0 的节点
        foreach($res as $k=>$v){
            if($v['pid'] == $pid) {
                //父级为根节点的id ，级别为0 ，也就是第一级的，
                $v['level'] = $level;
                //把数组放到infor 中
                $infor[] = $v;
                //开始递归，查找父id 为该节点的id,级别为原级别加1
                $this->GetcateInfor($res , $v['cate_id'] , $v['level'] + 1);
            }
        }
        //返回最后内容并输出
        return $infor;
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $data = $request->except('_token');
        $res = Cate::insert($data);
        if($res) {
            return redirect('/cate');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $cateList = Cate::get();
        $res = Cate::find($id);

        return view('admin.category.edit',['res'=>$res,'re'=>$cateList]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $data = $request->except('_token');
        dd($data);
        $res = Cate::where('cate_id',$id)->update($data);
        if($res) {
            return redirect('/cate');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $res = Cate::destroy($id);
        if($res) {
            return redirect('/cate');
        }
    }
}
