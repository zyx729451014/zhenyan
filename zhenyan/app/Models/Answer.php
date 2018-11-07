<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    public $table = 'answers';
     //配置模型  属于关系
    public function answersuser()
    {
    	return $this->belongsTo('App\User','uid');
    }
}
