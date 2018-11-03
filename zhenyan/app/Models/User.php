<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
	//设置模型主键
   	public $primaryKey = 'uid';
	// 对应关系
    public function userinvitation()
    {
        return $this->hasMany('App\Models\Invitation','uid','uid');
    }
}
