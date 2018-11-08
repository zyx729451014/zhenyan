<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Privatemess extends Model
{
    public $table = 'private';

    //配置模型  属于关系
    public function privateuser()
    {
    	return $this->belongsTo('App\User','uid');
    }
}
