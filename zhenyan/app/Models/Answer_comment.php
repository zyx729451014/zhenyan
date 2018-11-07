<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Answer_comment extends Model
{
    public $table = 'answers_comment';
	 //配置模型  属于关系
    public function answer_commentuser()
    {
    	return $this->belongsTo('App\User','uid');
    }
}
