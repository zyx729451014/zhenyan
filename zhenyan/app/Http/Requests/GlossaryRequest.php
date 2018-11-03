<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class GlossaryRequest extends Request
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
            'title' => 'required|max:20',
            'image' => 'required'
        ];
    }
    /**
     * 返回信息
     * @return [type] [description]
     */
    public function messages()
    {
        return [
            'title.required' => '标题不能为空',
            'title.max' => '标题最长为20个字符',
            'image.required' => '图片必须上传'

        ];
    }
}
