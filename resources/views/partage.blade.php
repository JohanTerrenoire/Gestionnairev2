@extends('layouts.app')

@section('title', 'Partagé avec moi')

@section('content')
  @if (!$combinaisons)
    <div class="alert alert-info">
      <h4>Aucun utilisateurs ne vous a partagé de mot de passe</h4>
    </div>
  @else
    <div class="table-responsive">
      <table class="table table-striped table-dark">
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
              @if ($combinaison->isEditable)
                <td><a class="btn btn-info" href="{{Route('combinaison.edit',['id' => $combinaison->id])}}">Modifier</a></td>
              @else
                <td></td>
              @endif
              <td>{{$combinaison->user->name}}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  @endif
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
