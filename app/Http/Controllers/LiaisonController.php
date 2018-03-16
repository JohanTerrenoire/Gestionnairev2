<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Liaison;
use App\Combinaison;

class LiaisonController extends Controller
{
    public function getPartage(){
      //Récupérer le mail de l'utilisateur connecté
      $user = Auth::user();

      //Récupérer tous les partages liés à cet utilisateur
      $query = Liaison::where('mail_partenaire', $user->email);
      $liaisons = $query->get();
      $combinaisons = [];
      //Récupération des combinaisons dans la table de liaison
      foreach ($liaisons as $liaison) {
        $combinaisons[] = Combinaison::find($liaison->combinaison_id);
      }
      //Décryptage des mots de passe
      foreach ($combinaisons as $combinaison) {
        $combinaison->password = decrypt($combinaison->password);
        $combinaison->isEditable = $combinaison->getLiaisonForUser(Auth::user())->isEditable;
      }

      return view('partage',[
        'combinaisons' => $combinaisons
      ]);
    }
}
