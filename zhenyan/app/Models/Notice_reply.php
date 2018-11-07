<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notice_reply extends Model
{
	 public $table = 'notice_reply';
    //配置模型  属于关系
    public function notice_replyuser()
    {
    	return $this->belongsTo('App\User','uid');
    }
}
