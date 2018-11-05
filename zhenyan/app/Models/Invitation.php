<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invitation extends Model
{
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
