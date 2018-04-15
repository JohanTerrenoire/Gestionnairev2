@extends('combinaison.base')

@section('title', 'Edition')

@section('combinaison_content')
<form action="#" method="post">
  @csrf
  <div class="form-group">
    <label for="libelle">Libellé</label>
    @if(Route::current()->getName() == 'share')
    <input class="form-control" type="text" name="libelle" value="{{$combinaison->libelle}}" disabled>
    @else
      <input class="form-control" type="text" name="libelle" value="{{$combinaison->libelle}}" required>
    @endif
  </div>
  <div class="form-group">
    <label for="identifiant">Identifiant</label>
    @if(Route::current()->getName() == 'share')
    <input class="form-control" type="text" name="identifiant" value="{{$combinaison->identifiant}}" required disabled>
    @else
      <input class="form-control" type="text" name="identifiant" value="{{$combinaison->identifiant}}" required>
    @endif
  </div>
  <div class="form-group">
    <label for="url">URL</label>
    @if(Route::current()->getName() == 'share')
    <input class="form-control" type="text" name="url" value="{{$combinaison->url}}" required disabled>
    @else
      <input class="form-control" type="text" name="url" value="{{$combinaison->url}}" required>
    @endif
  </div>
  <div class="form-group">
    <label for="password">Mot de passe</label>
    @if(Route::current()->getName() == 'share')
    <input class="form-control" type="text" name="password" value="{{$combinaison->password}}" required disabled>
    @else
      <input class="form-control" type="text" name="password" value="{{$combinaison->password}}" required>
    @endif
  </div>
  <div class="form-group">
    <label for="page">Catégorie</label>
    @if(Route::current()->getName() == 'share')
    <input class="form-control" type="text" name="page" value="{{$combinaison->page}}" required disabled>
    @else
      <input class="form-control" type="text" name="page" value="{{$combinaison->page}}" required>
    @endif
  </div>
  @yield('share')
  <div class="form-group">
    <input class="btn btn-success" type="submit" value="Valider">
  </div>
</form>
@endsection
