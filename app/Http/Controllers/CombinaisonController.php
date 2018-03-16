<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Combinaison;


class CombinaisonController extends Controller
{
  public function __construc(){
    $this->middleware('auth');
  }



  public function index(Request $request){
    $query  = Combinaison::where('user_id',Auth::id());

    if ($page = $request->input('page'))
      $query->where('page', $page);

    $combinaisons = $query->get();
    //Décodage des mots de passe
    foreach ($combinaisons as $combinaison) {
      $combinaison->password = decrypt($combinaison->password);
    }

    return view('combinaison.index', [
      "combinaisons"=> $combinaisons,
      "pages" => Combinaison::getDistinctPage()
    ]);
  }



  public function edit(Request $request ,$id = null){
    if ($id) {
      if(!$combinaison = Combinaison::find($id))
        throw new \Exception("La combinaison n'existe pas.", 1);
    }
    else{
      $combinaison = new Combinaison();
      $combinaison->user()->associate(Auth::user());
    }

    if ($request->isMethod('post')) {
      $combinaison->libelle = $request->input('libelle');
      $combinaison->identifiant = $request->input('identifiant');
      $combinaison->password = encrypt($request->input('password'));
      $combinaison->url = $request->input('url');
      $combinaison->page = $request->input('page');
      $combinaison->save();
      return redirect()->route('combinaison.index');
    }
    else {
      if($combinaison->password){
        $combinaison->password = decrypt($combinaison->password);
      }
      return view('combinaison.edit', [
        "combinaison" => $combinaison,
        "pages" => Combinaison::getDistinctPage()
      ]);
    }
  }




  public function remove($id){
    Combinaison::destroy($id);
    return redirect()->route('combinaison.index');
  }

}
