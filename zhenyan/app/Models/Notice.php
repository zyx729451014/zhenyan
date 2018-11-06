<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notice extends Model
{
    public $table = 'notice';
     //配置模型  属于关系
    public function noticeuser()
    {
    	return $this->belongsTo('App\User','uid');
    }
}
