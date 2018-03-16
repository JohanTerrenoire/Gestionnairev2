@extends('layouts.app')

@section('title', 'Partagé avec moi')

@section('content')
  <div class="row">
    <div class="col">
      <table class="table">
        <thead class="thead-dark">
          <tr>
            <th>Libellé</th>
            <th>Identifiant</th>
            <th>Mot de passe</th>
            <th>URL</th>
            <th>Catégorie</th>
            <th>Actions</th>
            <th>Propriétaire</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($combinaisons as $combinaison)
            <tr>
              <td>{{$combinaison->libelle}}</td>
              <td class="identifiant_field">{{$combinaison->identifiant}}</td>
              <td class="password_field" data-value="{{$combinaison->password}}">***************</td>
              <td> <a href="{{$combinaison->url}}" target="_blank">{{$combinaison->url}}</a> </td>
              <td>{{$combinaison->page}}</td>
              <td><a class="btn btn-info" href="{{Route('combinaison.edit',['id' => $combinaison->id])}}">Modifier</a>
                <a class="btn btn-danger" href="{{Route('combinaison.remove',['id' => $combinaison->id])}}">Supprimer</a></td>
              <td>{{$combinaison->user_id}}</td>
              </tr>
            @endforeach
        </tbody>
      </table>
    </div>
  </div>
@endsection
