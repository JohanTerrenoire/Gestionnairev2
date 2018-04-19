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
    try {
      //Si le mail renseigné n'est pas dans la table des utilisateurs
      if(!User::where('email', $request->input('mail_partenaire'))){
        throw new \Exception("L'email doit être renseigné", 1);
      }
      //Si le mail renseigné est dans la table des inscrits
      else {
        //Enregistrement du partage
        $user = Auth::user();
        $liaison = new Liaison();
        $liaison->user_id = $user->id;
        $liaison->mail_partenaire = $request->input('mail_partenaire');
        $liaison->combinaison_id = $combinaison_id;
        if ($request->has('isEditable')) {
          $liaison->isEditable = 1;
        }
        else {
          $liaison->isEditable = 0;
        }
        $liaison->save();
        //Ajout du flag isShare à l'enregistrement
        $combinaison = Combinaison::find($combinaison_id);
        $combinaison->isShare = 1;
        $combinaison->save();
        return redirect()->route('combinaison.index');
      }
    } catch (\Exception $e) {
      $request->session()->flash('error', $e->getMessage());
      return redirect()->route('share',[
        "id" => $combinaison_id]);
    }
  }

  public function sharedPassword(){
    //Récupérer toutes les combinaisons partagées
    $user = Auth::user();
    $query = Liaison::where('user_id', "=", $user->id);//Les liaisons de l'utilisateurs courant partagées
    $liaisons = $query->get();
    foreach ($liaisons as $liaison) {
      $combinaison = Combinaison::find($liaison->combinaison_id);
      $liaison->libelle = $combinaison->libelle;
      $liaison->categorie = $combinaison->page;
      $liaison->url = $combinaison->url;
    }
    return view('sharedPassword', [
      "liaisons" => $liaisons
    ]);
  }

  public function stopPartage($liaison_id){
    //Enlever le flag  isShare de la combinaison
    $liaison = Liaison::find($liaison_id);
    //Si la combinaison est encore référencée dans une liaison, laisser le flag isShare
    $query = Liaison::where('combinaison_id', "=", $liaison->combinaison_id);
    $liaison = $query->get();
    if (!$liaison) {
      $combinaison = Combinaison::find($liaison->combinaison_id);
      $combinaison->isShare = 0;
      $combinaison->save();
    }
    //Enlever la liaison de la base de données
    Liaison::destroy($liaison_id);
    return redirect()->route('combinaison.index');
  }
}
