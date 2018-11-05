<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invi_reply extends Model
{
   	//配置模型  属于关系
    public function invi_replyuser()
    {
    	return $this->belongsTo('App\User','uid');
    }
}
