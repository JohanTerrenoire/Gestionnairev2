@extends('layouts.app')

@section('title', 'Générateur')

@section('content')
<div class="form-group">
  <input type="checkbox" id="chk_maj">
  <label for="chk_maj" class="form-check-input">Avec des majuscules</label>
</div>
<div class="form-group">
  <input type="checkbox" id="chk_spe">
  <label for="chk_spe">Avec des caractères spéciaux</label>
</div>
<div class="form-group">
  <label for="gen_mdp">Votre mot de passe : </label>
  <input type="text" id="gen_mdp" class="form-control">
</div>
<div class="form-group">
  <input type="button" id="btn-valider" value="Valider" class="btn btn-info">
</div>
@endsection


@section('scripts')

@endsection
