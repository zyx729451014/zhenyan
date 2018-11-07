<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notice_comment extends Model
{
	public $table = 'notice_comment';
	 //配置模型  属于关系
    public function notice_commentuser()
    {
    	return $this->belongsTo('App\User','uid');
    }
}
