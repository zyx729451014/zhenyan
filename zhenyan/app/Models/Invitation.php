<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Invitation extends Model
{
	use SoftDeletes;
	//关联
    public function invitationuser()
    {
        return $this->belongsTo('App\User','uid');
    }
    /* public function invitationcates()
    {
          return $this->belongsTo('App\Models\Cates', 'cid', 'cid');
    }*/
  
}
