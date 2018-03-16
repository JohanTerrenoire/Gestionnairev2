<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Combinaison extends Model
{
    public function user(){
      return $this->belongsTo('App\User', 'user_id');
    }
    public function liaisons(){
      return $this->hasMany('App\Liaison', 'combinaison_id');
    }

    public static function getDistinctPage(){
      $pages = [];
      foreach (DB::table('combinaisons')->select('page')->distinct()->get() as $key => $value) {
        $pages[] = $value->page;
      }
      return $pages;
    }

    public function getLiaisonForUser(User $user){
      foreach ($this->liaisons as $liaison) {
        if ($liaison->mail_partenaire == $user->email) {
          return $liaison;
        }
      }
      return new Liaison();
    }
}
