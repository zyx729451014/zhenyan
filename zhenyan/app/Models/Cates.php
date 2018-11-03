<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cates extends Model
{
  	//设置模型主键
   	public $primaryKey = 'cid';
   	// 配置对应关系
   	public function catesinfo()
    {
        return $this->hasOne('App\Models\Invitation','cid');
    }
    static public function getCates($cates=[] , $id=0)
	{

		if(empty($cates)){
			$cates = self::all();
		}

		$arr = [];
		foreach($cates as $k=>$v){
			if($v->pid == $id){
				$v->sub = self::getCates($cates,$v->cid); 
				$arr[] = $v;
			}
		}

		return $arr;
	}
	// 对应关系
    public function cateinvitation()
    {
        return $this->hasMany('App\Models\Invitation','cid','cid');
    }

}
