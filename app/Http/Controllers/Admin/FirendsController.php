<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Firends;
use App\Http\Requests\FirendsPost;
use Illuminate\Validation\Rule;

class FirendsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $f_name = request()->f_name;
        $where = [];
        if($f_name) {
            $where[] = ['f_name','like',"%$f_name%"];
        }

        $pageSize = config('app.pageSize');
        $res = Firends::where($where)->paginate($pageSize);
        if(request()->ajax()) {
            return view('admin.firends.ajax',['firendsInfo'=>$res,'f_name'=>$f_name]);
        }
        return view('admin.firends.index',['firendsInfo'=>$res,'f_name'=>$f_name]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.firends.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FirendsPost $request)
    {
        //
        $data = request()->except('_token');
        //文件上传
        if ($request->hasFile('f_img')) {
            //
            $data['f_img'] =upload('f_img');

        }
        $res = Firends::insert($data);
//        dd($res);
        if($res) {
            return redirect('firends');
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
        $res = Firends::find($id);
        return view('admin.firends.edit',['res'=>$res]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(FirendsPost $request, $id)
    {
        //
        //
        $data = request()->except('_token');
        //文件上传
        if ($request->hasFile('f_img')) {
            //
            $data['f_img'] =upload('f_img');

        }
        $res = Firends::where('f_id',$id)->update($data);
        if($res !== false) {
            return redirect('firends');
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
        $res = Firends::destroy($id);
        if($res) {
            return json_encode(['error_no'=>'0','error_msg'=>'删除成功']);die;
        } else {
            return json_encode(['error_no'=>'1','error_msg'=>'删除失败']);die;
        }
    }
}
