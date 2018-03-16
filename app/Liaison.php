<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Liaison extends Model
{
    public function user(){
      return $this->belongsTo('App\User', 'user_id');
    }
    public function combinaison(){
      return $this->belongsTo('App\Combinaison', 'combinaison_id');
    }
}
