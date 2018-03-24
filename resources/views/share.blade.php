@extends('combinaison.edit')

@section('share')
  <div class="form-group">
    <label for="mail_partenaire">Adresse Email du partenaire </label>
    <input type="text" class="form-control" name="mail_partenaire" required>
  </div>
@endsection
{{-- @extends('combinaison.base')

@section('content')
  <form action="#" method="post">
    <div class="form-group">
      <label for="libelle">Libellé</label>
      <input class="form-control" type="text" name="libelle" value="{{$combinaison->libelle}}" >
    </div>
    <div class="form-group">
      <label for="mail_partenaire">Adresse Email du partenaire </label>
      <input type="text" class="form-control" name="mail_partenaire" required>
    </div>
    <div class="form-group">
      <input class="btn btn-success" type="submit" value="Valider">
    </div>
  </form>
@endsection

@section('scripts')

@endsection --}}
