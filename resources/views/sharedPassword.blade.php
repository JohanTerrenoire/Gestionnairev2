@extends('layouts.app')

@section('title', 'Partagé avec d\'autres')

@section('content')
  <div class="table-responsive">
    <table class="table table-striped table-dark">
      <thead class="thead-dark">
        <tr>
          <th>Libellé</th>
          <th>URL</th>
          <th>Catégorie</th>
          <th>Email du partenaire</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($liaisons as $liaison)

          <tr>
            <td>{{$liaison->libelle}}</td>
            <td><a href="{{$liaison->url}}">{{$liaison->url}}</a></td>
            <td>{{$liaison->categorie}}</td>
            <td>{{$liaison->mail_partenaire}}</td>
            <td><a class="btn btn-outline-danger" href="{{Route('partage.stopPartage',['id' => $liaison->id])}}">Stopper le partage</a></td>
          </tr>

        @endforeach
      </tbody>
    </table>
  </div>
@endsection
