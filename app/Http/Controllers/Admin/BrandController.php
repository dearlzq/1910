<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Brand;
use think\response\Redirect;
use App\Http\Requests\StoreBlogPost;
use Validator;
use Illuminate\Validation\Rule;


class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *展示页面
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $b_name = request()->b_name;
        $where = [];
        if($b_name) {
            $where[] = ['b_name','like',"%$b_name%"];
        }
        $pagesize = config('app.pageSize');
        $brandList = Brand::where($where)->paginate($pagesize);
        if(request()->ajax()) {
            return view('admin.brand.ajax',['brandList'=>$brandList,'b_name'=>$b_name]);
        }
        return view('admin.brand.index',['brandList'=>$brandList,'b_name'=>$b_name]);
    }

    /**
     * Show the form for creating a new resource.
     *添加
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.brand.create');
    }

    /**
     * Store a newly created resource in storage.
     *执行添加页面
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
//    public function store(StoreBlogPost $request)
    {
        //验证
//        $request = validate([
//            //unique:brands:表名
//            'b_name' => 'required|unique:brands|max:20',
//            'b_url' => 'required',
//            ],[
//                //required:必填，unique:唯一性
//                //转化为中文
//            'b_name.required' =>'品牌名称必填',
//            'b_name.unique' =>'品牌名称已存在',
//            'b_name.max' =>'品牌名称最大20位',
//            'b_url.required' =>'品牌网址必填',
//        ]);
        $data = request()->except('_token');
        $Validator = Validator::make($data,[
                'b_name' => 'required|unique:brands|max:20',
                'b_url' => 'required',
            ],[
            //required:必填，unique:唯一性
            //转化为中文
            'b_name.required' =>'品牌名称必填',
            'b_name.unique' =>'品牌名称已存在',
            'b_name.max' =>'品牌名称最大20位',
            'b_url.required' =>'品牌网址必填',
        ]);
        if($Validator->fails()) {
            return redirect('brand/create')->withErrors($Validator)->withInput();
        }

        //文件上传
        if ($request->hasFile('b_logo')) {
            //
            $data['b_logo'] =upload('b_logo');

        }
        $res = Brand::insert($data);
        if($res) {
            return redirect('brand');
        }

    }

    /**
     * Display the specified resource.
     *详情页面
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *修改
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //first()  查出一条
//        $res = DB::table('brands') ->where('b_id', $id) ->first();
            $res = Brand::find($id);
        return view('admin.brand.edit',['brand'=>$res]);
    }

    /**
     * Update the specified resource in storage.
     *执行修改
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //排除自身id
        $post = $request->except('_token');
        $Validator = Validator::make($post, [
            'b_name' => [
                'required',
                Rule::unique('brands')->ignore($id,'b_id'),
            'max:20',
            ],
                //required:必填，unique:唯一性
                //转化为中文
                'b_name.required' =>'品牌名称必填',
                'b_name.unique' =>'品牌名称已存在',
                'b_name.max' =>'品牌名称最大20位',
                'b_url.required' =>'品牌网址必填',
            ]);
        if($Validator->fails()) {
            return redirect('brand/edit/'.$id)->withErrors($Validator)->withInput();
        }

        //文件上传
        if ($request->hasFile('b_logo')) { //
            //
            $post['b_logo'] =upload('b_logo');

        }
//        $res = DB::table('brands') ->where('b_id', $id) ->update($post);
        $res = Brand::where('b_id',$id)->update($post);
        if($res!==false) {
            return redirect('/brand');
        }
    }

    /**
     * Remove the specified resource from storage.
     *删除
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $re = DB::table('brands')->where('b_id',$id)->value('b_logo');
        if($re) {
            //unlink 删除图片
            unlink(storage_path('app/'.$re));
        }
//        $res = DB::table('brands')->where('b_id', $id)->delete ();
        $res = Brand::destroy($id);
        if($res) {
            return redirect('brand');
        }


    }
}
