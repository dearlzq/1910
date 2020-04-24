<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Admin;
use App\Http\Requests\AdminPost;


class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $res = Admin::get();
        return view('admin.admins.index',['adminInfo'=>$res]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.admins.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminPost $request)
    {
        //
        $data = request()->except(['_token','a_ewpwd']);
        $data['a_create'] = time();
        $data['a_pwd'] = encrypt($data['a_pwd']);


        $res = Admin::insert($data);
        if($res) {
            return redirect('admins');
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
        $res = Admin::find($id);
        return view('admin.admins.edit',['res'=>$res]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdminPost $request, $id)
    {
        //
        $data = request()->except(['_token','a_ewpwd']);
        $data['a_create'] = time();
        $data['a_pwd'] = encrypt($data['a_pwd']);

        $res = Admin::where('a_id',$id)->update($data);
        if($res) {
            return redirect('/admins');
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
        $res = Admin::destroy($id);
        if($res) {
            return redirect('/admins');
        }
    }
}
