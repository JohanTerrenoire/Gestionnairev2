@extends('combinaison.edit')

@section('share')
  @if (session()->get('error'))
    <div class="alert alert-danger">Merci de vérifier l'adresse mail de votre partenaire</div>
  @endif
  <div class="form-group">
    <label for="mail_partenaire">Adresse Email du partenaire </label>
    <input type="text" class="form-control" name="mail_partenaire" required>
  </div>
  <div class="form-group">
    <input name="isEditable" type="checkbox" >
    <label for="isEditable">Modifiable par le partenaire</label>
  </div>
@endsection
