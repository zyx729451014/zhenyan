<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UsersStoreRequest extends Request
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
        // 验证规则
        return [
            'uname'   => 'required|between:3,10|alpha|unique:users,uname',
            'upass'   => 'required|between:6,12',
            'upassok' => 'required|same:upass',
            'phone'   => 'required|regex:/^1{1}[345678]{1}[\d]{9}$/',
            'email'   => 'required|email',
            'identity'    => 'required',
        ];
    }

    public function messages()
    {
        return [
            'uname.required'   => '用户名不能为空',
            'uname.between'    => '用户名格式不正确',
            'uname.alpha'      => '用户名只允许是字母',
            'uname.unique'     => '用户已存在',
            'upass.required'   => '密码不能为空',
            'upass.between'    => '密码在6-12个字符之间',
            'upassok.required' => '请输入确认密码',
            'upassok.same'     => '密码与确认密码不一致',
            'phone.required'   => '手机号不能为空',
            'phone.regex'      => '手机号格式不正确',
            'email.required'   => '邮箱不能为空',
            'email.email'      => '邮箱格式不正确',
            'identity.required'    => '权限不能为空',
        ];
    }

   
}
