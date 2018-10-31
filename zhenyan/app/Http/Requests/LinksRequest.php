<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class LinksRequest extends Request
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
     * 验证友情链接规则.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'lname' => 'required|max:6',
            'lurl' => 'required|url',
            'status'=> 'required'
        ];
    }
    /**
     * 返回信息
     * @return [type] [description]
     */
    public function messages()
    {
        return [
            'lname.required' => '链接名称不能为空',
            'lname.max' => '链接名称最长为6个字符',
            'lurl.required'  => '链接URL地址不能为空',
            'lurl.url'  => '链接URL地址格式不正确',
            'status' => '状态不能为空',
        ];
    }
}
