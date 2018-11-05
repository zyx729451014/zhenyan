<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Glocomment extends Model
{
    // 设置当前表名
    protected $table = 'glossary_comment';

    //属于关系
    public function commentuser()
    {
        return $this->belongsTo('App\User','uid');
    }
}
