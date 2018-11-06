<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gloreply extends Model
{
     // 设置当前表名
    protected $table = 'glossary_reply';
    // 配置模型 属于关系
    public function replyuser()
    {
        return $this->belongsTo('App\User','uid');
    }
}
