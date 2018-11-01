<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class AdverRequest extends Request
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
     * 验证推荐位广告规则.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'atitle' => 'required|max:20',
            'aurl' => 'required|url',
            'apic' => 'image',
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
            'atitle.required' => '链接名称不能为空',
            'atitle.max'      => '链接名称最长为20个字符',
            'aurl.required'  => '链接URL地址不能为空',
            'aurl.url'       => '链接URL地址格式不正确',
            'apic.image'     => '图片格式必须为（ jpeg、png、bmp、gif、 或 svg ）',
            'status'         => '状态不能为空',
        ];
    }
}
