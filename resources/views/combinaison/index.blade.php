@extends('layouts.app')

@section('content')

<table class="table">
  <thead class="thead-dark">
    <tr>
      <th>libelle</th>
      <th>identifiant</th>
      <th>Mot de passe</th>
      <th>URL</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($combinaisons as $combinaison)
      <tr>
        <td>{{$combinaison->libelle}}</td>
        <td>{{$combinaison->identifiant}}</td>
        <td>{{$combinaison->password}}</td>
        <td>{{$combinaison->url}}</td>
        <td><a class="btn btn-dark" href="{{Route('combinaison.edit',['id' => $combinaison->id])}}">Modifier</a>
        <a class="btn btn-danger" href="{{Route('combinaison.remove',['id' => $combinaison->id])}}">Supprimer</a></td>
      </tr>
    @endforeach
  </tbody>
</table>
<a class="btn btn-dark" href="{{Route('combinaison.edit')}}">Ajouter</a>
@endsection
