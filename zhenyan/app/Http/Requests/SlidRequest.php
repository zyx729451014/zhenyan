<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class SlidRequest extends Request
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
     * 验证网站管理信息规则.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'sname' => 'required|max:10',
            'status' =>'required',
            'surl' => 'required|url',
            'simg' => 'image'
        ];
    }
    /**
     * 返回信息
     * @return [type] [description]
     */
    public function messages()
    {
        return [
            'sname.required' => '广告名称不能为空',
            'sname.max' => '广告名称最长为6个字符',
            'surl.required'  => '链接URL地址不能为空',
            'surl.url'  => '链接URL地址格式不正确',
            'status.required' => '状态不能为空',
            'simg.image' => '图片格式必须为（ jpeg、png、bmp、gif、 或 svg ）'

        ];
    }
}
