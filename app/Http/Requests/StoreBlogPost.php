<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBlogPost extends FormRequest
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
        return [
            //unique:brands:表名
            'b_name' => 'required|unique:brands|max:20',
            'b_url' => 'required',
        ];

    }
    //错误提示
    public function messages()
    {
        return [
            'b_name.required' =>'品牌名称必填',
            'b_name.unique' =>'品牌名称已存在',
            'b_name.max' =>'品牌名称最大20位',
            'b_url.required' =>'品牌网址必填',
        ];
    }
}
