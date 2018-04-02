<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Liaison;
use App\Combinaison;
use App\User;

class LiaisonController extends Controller
{
  // Obtenir la vue avec toutes les combinaisons qui sont partagées pour l'utilisateur
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

  //Obtenir un formulaire pour partager avec un partenaire la combinaison courante
  public function getVueShareCombinaison($combinaison_id){
    $combinaison = Combinaison::find($combinaison_id);
    $combinaison->password = decrypt($combinaison->password);
    return view('share', [
      "combinaison" => $combinaison
    ]);
  }

  public function postUserShareCombinaison(Request $request, $combinaison_id){
    //Si le mail renseigné n'est pas dans la table des utilisateurs
    if(User::where($request->input('mail_partenaire'))){

    }
    //Si le mail renseigné est dans la table des inscrits
    else {
      $user = Auth::user();
      $liaison = new Liaison();
      $liaison->user_id = $user->id;
      $liaison->mail_partenaire = $request->input('mail_partenaire');
      $liaison->combinaison_id = $combinaison_id;
      $liaison->isEditable = 1;
      $liaison->save();
      return redirect()->route('combinaison.index');
    }
  }
}
