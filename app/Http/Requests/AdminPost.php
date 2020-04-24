<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class AdminPost extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        //获取路由别名
        $name = \Route::currentRouteName();
        if($name == 'adminstore') {
            //添加
            return [
                //unique:brands:表名   required:必填   unique:唯一性
                'a_name' => 'required|unique:admins',
                'a_tel' => 'required',
                'a_email' => 'required|numeric|digits_between:0,7',
                'a_pwd' => 'required|between:6,12',
                'a_ewpwd' => 'required|between:6,12',
            ];
        }

        if($name == 'adminupdate') {
            //bian编辑
            return [
                //unique:brands:表名   required:必填   unique:唯一性
                'a_name' => [
                    Rule::unique('admins')->ignore(request()->id,'a_id'),
                    'required'
                ],
                'a_tel' => 'required',
                'a_email' => 'required|numeric|digits_between:0,7',
                'a_pwd' => 'required|between:6,12',
                'a_ewpwd' => 'required|between:6,12',
            ];
        }

    }
    public function messages()
    {
        return [
            'a_name.required' =>'名称必填',
            'a_name.unique' =>'名称已存在',
            'a_name.between' => '名称0到17位',
            'a_tel.required' =>'手机号必填',

            'a_email.required' =>'邮箱必填',

            'a_pwd.required' => '密码必填',
            'a_ewpwd.required' => '确认密码必填',

        ];
    }
}
