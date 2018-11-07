<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Friending extends Model
{
   protected $table = 'friending';
   public function friendinguser()
    {
        return $this->belongsTo('App\User','uid');
    }
}
