<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Answer_reply extends Model
{
    public $table = 'answers_reply';
    //配置模型  属于关系
    public function answer_replyuser()
    {
    	return $this->belongsTo('App\User','uid');
    }
    
}
