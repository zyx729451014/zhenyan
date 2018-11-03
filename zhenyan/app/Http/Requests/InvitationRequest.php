<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class InvitationRequest extends Request
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
     * 验证帖子规则.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|max:50',
            'cid'   => 'required',
            'content' => 'required'
        ];
    }

    /**
     * 返回信息
     * @return [type] [description]
     */
    public function messages()
    {
        return [
            'title.required' => '帖子名称不能为空',
            'title.max'      => '帖子名称最长为50个字符',
            'cid.required'  => '帖子分类不能为空',
            'content.required'  => '帖子内容不能为空'
        ];
    }

}
