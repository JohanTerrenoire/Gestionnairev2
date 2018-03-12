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
  public function index(){
    $user = Auth::user();
    $combinaisons = $user->combinaisons;
    return view('combinaison.index', [
      "combinaisons"=> $combinaisons
    ]);
  }
  public function edit(Request $request ,$id = null){
    if ($id) {
      if(!$combinaison = Combinaison::find($id))
        throw new \Exception("La combinaison n'existe pas.", 1);
    }
    else
      $combinaison = new Combinaison();

    if ($request->isMethod('post')) {
      $combinaison->libelle = $request->input('libelle');
      $combinaison->identifiant = $request->input('identifiant');
      $combinaison->password = $request->input('password');
      $combinaison->url = $request->input('url');
      $combinaison->page = $request->input('page');
      $combinaison->user()->associate(Auth::user());
      $combinaison->save();
      return redirect()->route('combinaison.index');
    }
    else {
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
