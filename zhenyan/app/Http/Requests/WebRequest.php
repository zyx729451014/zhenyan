<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class WebRequest extends Request
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
            'name' => 'required|max:6',
            'describe' => 'required|max:40',
            'filing' => 'required',
            'telephone' => 'required',
            'statu' =>'required',
            'url' => 'required|url',
            'cright' => 'required',
            'logo' => 'image'
        ];
    }
    /**
     * 返回信息
     * @return [type] [description]
     */
    public function messages()
    {
        return [
            'name.required' => '网站名称不能为空',
            'name.max' => '网站名称最长为6个字符',
            'url.required'  => '链接URL地址不能为空',
            'url.url'  => '链接URL地址格式不正确',
            'statu.required' => '状态不能为空',
            'describe.required' => '描述不能为空',
            'describe.max' => '最长为40个字符',
            'filing.required' => '网站备案号不能为空',
            'telephone.required' => '联系方式不能为空',
            'cright.required' => '版权信息不能为空',
            'logo.image' => '图片格式必须为（ jpeg、png、bmp、gif、 或 svg ）'

        ];
    }
}
