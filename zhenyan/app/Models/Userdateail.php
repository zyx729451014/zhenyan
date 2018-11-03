<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model; 

class Userdateail extends Model
{
    // 设置当前表名
    protected $table = 'user_dateails';
    public function userinfo2()
    {
        return $this->belongsTo('App\Models\User','uid');
    }
}
