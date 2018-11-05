<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invi_comment extends Model
{
   	//配置模型  属于关系
    public function invi_commentuser()
    {
    	return $this->belongsTo('App\User','uid');
    }
}
