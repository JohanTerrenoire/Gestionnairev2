@extends('combinaison.base')

@section('title', 'DashBoard')
@section('combinaison_content')
<div class="row">
  {{--  La barre de navigation entre les catégories --}}
  <ul class="nav nav-tabs" id="myTab" role="tablist">
    @foreach($finalCombinaisons as $page => $combinaisons)
      <li class="nav-item">
        <a class="nav-link {{ ($loop->first) ? 'active' : '' }}" id="tab-{{ $page }}" data-toggle="tab" href="#{{ $page }}" role="tab" aria-controls="{{ $page }}" {{ ($loop->first) ? 'aria-selected="true"' : '' }}>{{ $page }}</a>
      </li>
    @endforeach
  </ul>
</div>
<div class="row">
  <div class="tab-content" id="myTabContent" style="width: 100%">
    @foreach($finalCombinaisons as $page => $combinaisons)
        <div class="tab-pane fade {{ ($loop->first) ? 'show active' : '' }} " id="{{ $page }}" role="tabpanel" aria-labelledby="tab-{{ $page }}">
          <div class="table-responsive">
            <table class="table table-striped">
              <thead class="thead-dark">
                <tr>
                  <th>Libellé</th>
                  <th>Identifiant</th>
                  <th>Mot de passe</th>
                  <th>URL</th>
                  <th>Catégorie</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($combinaisons as $combinaison)
                  <tr>
                    <td>{{$combinaison->libelle}}
                    </td>
                    <td class="identifiant_field">{{$combinaison->identifiant}}</td>
                    <td class="password_field" data-value="{{$combinaison->password}}">***************</td>
                    <td> <a href="{{$combinaison->url}}" target="_blank">{{$combinaison->url}}</a> </td>
                    <td>{{$combinaison->page}}</td>
                    <td><a class="btn btn-outline-info" href="{{Route('combinaison.edit',['id' => $combinaison->id])}}">Modifier</a>
                      <a class="btn btn-outline-danger" href="{{Route('combinaison.remove',['id' => $combinaison->id])}}">Supprimer</a>
                      <a class="btn btn-outline-success" href="{{Route('share', ['id' => $combinaison->id])}}">Partager</a>
                        @if ($combinaison->isShare)
                        <img src="{{ asset('img/share.png')}}" height="20px"/>
                        @endif
                    </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
              <a class="btn btn-outline-info" href="{{Route('combinaison.edit')}}">Ajouter</a>
          </div>
        </div>
    @endforeach
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
