<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Glocomment extends Model
{
    // 设置当前表名
    protected $table = 'glossary_comment';

    // 配置模型 属于关系
    public function commentuser()
    {
        return $this->belongsTo('App\User','uid');
    }

    // 配置模型 属于关系
    public function commentglo()
    {
        return $this->belongsTo('App\Models\Glossary','gid');
    }
}
