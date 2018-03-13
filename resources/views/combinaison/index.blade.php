@extends('combinaison.base')

@section('title', 'DashBoard')
@section('combinaison_content')
<div class="row">
  <div class="col">
    <form class="form-inline" action="#" method="post">
      @csrf
      <div class="form-group">
        <select class="form-control" name="page">
          <option value="" >Tout</option>
          @foreach($pages as $page)
            <option>{{ $page }}</option>
          @endforeach
        </select>
        <button type="submit" name="" class="btn btn-dark">Filtrer</button>
      </div>
    </form>
  </div>
</div>
<div class="row">
  <div class="col">
    <table class="table">
      <thead class="thead-dark">
        <tr>
          <th>libelle</th>
          <th>identifiant</th>
          <th>Mot de passe</th>
          <th>URL</th>
          <th>Catégorie</th>
          <th>Actions</th>
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
            <td><a class="btn btn-dark" href="{{Route('combinaison.edit',['id' => $combinaison->id])}}">Modifier</a>
              <a class="btn btn-danger" href="{{Route('combinaison.remove',['id' => $combinaison->id])}}">Supprimer</a></td>
            </tr>
          @endforeach
        </tbody>
      </table>
      <a class="btn btn-dark" href="{{Route('combinaison.edit')}}">Ajouter</a>
  </div>
</div>
@endsection

@section('scripts')
  <!--Script pour les actions de la souris sur le champ mot de passe-->
  <script type="text/javascript">
    $('.password_field').mouseover(function(){
      var $this = $(this);
      $this.text($this.data('value'));
    })
    .mouseleave(function() {
      var $this = $(this);
      $this.text("***************")
    })
    .click(function() {
      var $this = $(this);
      $this.select();
      document.execCommand('copy');
    });
  </script>
  <!--Script pour le clique sur le champs identifiant-->
  <script type="text/javascript">
    $('.identifiant_field').click(function(){
      var $this = $(this);
      $this.select();
      document.execCommand('copy');
    });
  </script>
@endsection
