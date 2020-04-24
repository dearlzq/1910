<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Cate;
use App\Goods;
use App\Brand;
use App\Http\Requests\GoodsPost;
use Illuminate\Support\Facades\DB;
use think\response\Redirect;


class GoodsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //三表联查
        $b_name = request()->b_name;
        $goods_name = request()->goods_name;
        $cate_name = request()->cate_name;
        $where = [];
        if($goods_name) {
            $where[] = ['goods_name','like',"%$goods_name%"];
        }
        if($cate_name) {
            $where[] = ['goods.cate_id',$cate_name];
        }
        if($b_name) {
            $where[] = ['goods.brand_id',$b_name];
        }


        $pageSize = config('app.pageSize');
        $brand = Brand::get();
        $cate = Cate::get();
        $cateInfo = GetcateInfor($cate);
        $goodsInfo = Goods::leftjoin('brands','goods.brand_id','=','brands.b_id')
            ->leftjoin('category','goods.cate_id','=','category.cate_id')
            ->where($where)
            ->paginate($pageSize);
        $query =request()->all();
        if(request()->ajax()) {
            return view('admin.goods.ajax',['goodsInfo'=>$goodsInfo,'brandInfo'=>$brand,'cateInfo'=>$cateInfo,'query'=>$query]);
        }
         return view('admin.goods.index',['goodsInfo'=>$goodsInfo,'brandInfo'=>$brand,'cateInfo'=>$cateInfo,'query'=>$query]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //分类
        $cate = Cate::get();
        $cateInfo = GetcateInfor($cate);
        //品牌
        $brandInfo = Brand::get();
        return view('admin.goods.create',['cateInfo'=>$cateInfo,'brandInfo'=>$brandInfo]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GoodsPost $request)
    {
        //

        $data = $request->except('_token');
        //文件上传
        if ($request->hasFile('goods_img')) {
            $data['goods_img'] =upload('goods_img');
        }
        //多文件
        if($request->hasFile('goods_imgs')) {
            $imgs =moreupload('goods_imgs');
            $data['goods_imgs'] =implode('|',$imgs);
        }
        $res = Goods::insert($data);
        if($res) {
            return redirect('/goods');
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
        //查出一条
        $res = Goods::find($id);
        $brand = Brand::get();
        $cate = Cate::get();
        $cateInfo = GetcateInfor($cate);

        return view('admin.goods.edit',['res'=>$res,'brandInfo'=>$brand,'cateInfo'=>$cateInfo]);
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
        //文件上传
        if ($request->hasFile('goods_img')) {
            //
            $data['goods_img'] =upload('goods_img');
        }
        //多文件
        if($request->hasFile('goods_imgs')) {
            $imgs = moreupload('goods_imgs');
            $data['goods_imgs'] =implode('|',$imgs);
        }
        $res = Goods::where('goods_id',$id)->update($data);
        if($res) {
            return redirect('/goods');
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
        //删除
        $res = Goods::destroy($id);
        if($res) {
            return redirect('/goods');
        }
    }
}
