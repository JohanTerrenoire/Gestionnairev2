@extends('combinaison.base')

@section('title', 'Edition')

@section('combinaison_content')
<form action="#" method="post">
  @csrf
  <div class="form-group">
    <label for="libelle">Libellé</label>
    <input class="form-control" type="text" name="libelle" value="{{$combinaison->libelle}}">
  </div>
  <div class="form-group">
    <label for="identifiant">Identifiant</label>
    <input class="form-control" type="text" name="identifiant" value="{{$combinaison->identifiant}}">
  </div>
  <div class="form-group">
    <label for="url">URL</label>
    <input class="form-control" type="text" name="url" value="{{$combinaison->url}}">
  </div>
  <div class="form-group">
    <label for="password">Mot de passe</label>
    <input class="form-control" type="text" name="password" value="{{$combinaison->password}}">
  </div>
  <div class="form-group">
    <label for="page">Page</label>
    <input class="form-control" type="text" name="page" value="{{$combinaison->page}}">
  </div>
  <div class="form-group">
    <input class="btn btn-success" type="submit" value="Valider">
  </div>
</form>
@endsection
