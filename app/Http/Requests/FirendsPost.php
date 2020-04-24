<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class FirendsPost extends FormRequest
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
        //获取路由的别名
        $name = \Route::currentRouteName();
        if($name == 'firendsstore') {
            return [
                //unique:brands:表名   required:必填   unique:唯一性
                'f_name' => 'required|unique:firends|alpha_dash',
                'f_url' => 'required',
            ];
        }
        if($name =='firendsupdate') {
            return [
                //unique:brands:表名   required:必填   unique:唯一性
                'f_name' => [
                    Rule::unique('firends')->ignore(request()->id,'f_id'),
                    'required',
                    'alpha_dash'
                ],
                'f_url' => 'required',
            ];
        }

    }
    public function messages()
    {
        return [
            'f_name.required' =>'网址名称必填',
            'f_name.unique' =>'网址名称已存在',
            'f_name.alpha_dash' => '可以使用中文、数字、字母、下划线',
            'f_url.required' =>'网址名称必填',
        ];
    }
}
