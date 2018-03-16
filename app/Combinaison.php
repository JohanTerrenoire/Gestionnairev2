<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Combinaison extends Model
{

    public function user(){
      return $this->belongsTo('App\User', 'user_id');
    }

    public static function getDistinctPage(){
      $pages = [];
      foreach (DB::table('combinaisons')->select('page')->distinct()->get() as $key => $value) {
        $pages[] = $value->page;
      }
      return $pages;
    }

}
