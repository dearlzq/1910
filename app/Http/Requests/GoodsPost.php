<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class GoodsPost extends FormRequest
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
            //
            //unique:brands:表名   required:必填   unique:唯一性
            'goods_name' => 'required|unique:goods|between:2,50|alpha_dash',
            'cate_id' => 'required',
            'goods_num' => 'required|numeric|digits_between:0,7',
            'brand_id' => 'required',
            'goods_price' => 'required|numeric',
        ];
    }

    public function messages()
    {
        return [
            'goods_name.required' =>'商品名称必填',
            'goods_name.unique' =>'商品名称已存在',
            'goods_name.between' => '商品名字2~50位',
            'goods_name.alpha_dash' => '可以使用中文、数字、字母、下划线',
            'goods_num.required' =>'商品库存必填',
            'goods_num.numeric' => '库存必须为数字',
            'cate_id.required' =>'商品分类必填',
            'goods_num.digits_between' => '库存不能超过8位',
            'brand_id.required' =>'品牌必填',
            'goods_price.required' =>'商品价格必填',
            'goods_price.numeric' => '价格必须为数字',

        ];
    }
}
