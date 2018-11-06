<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invi_collect extends Model
{
    public $table = 'invi_collect';
    //配置模型  属于关系
    public function invi_collectinvi()
    {
    	return $this->belongsTo('App\Models\invitation','iid');
    }
}
