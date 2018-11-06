<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Glossary extends Model
{
	use SoftDeletes;
    public $table = 'glossary';
    
    //配置模型  属于关系
    public function glossaryuser()
    {
    	return $this->belongsTo('App\User','uid');
    }

}
