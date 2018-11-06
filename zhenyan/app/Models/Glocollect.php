<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Glocollect extends Model
{
    // 设置当前表名
    protected $table = 'glossary_collect';

    // 配置模型 属于关系
    public function collectglo()
    {
        return $this->belongsTo('App\Models\Glossary','gid');
    }
}
