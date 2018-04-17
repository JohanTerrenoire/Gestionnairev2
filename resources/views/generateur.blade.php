@extends('layouts.app')

@section('title', 'Générateur')

@section('content')
    <h3>Générer un mot de passe</h3><br/>
    <div class="row">
      <div class="col-md">
        <div class="form-group">
          <label for="list_nb">Nombre de caractères :</label>
          <select name="list_nb" id="comboNbCaract">
            @for ($i = 1; $i < 101; $i++)
              <option value="{{ $i }}">{{ $i }}</option>
            @endfor
          </select>
        </div>
        <div class="form-group">
          <input name="withMajuscules" type="checkbox" id="checkbox_majuscules">
          <label for="withMajuscules">Avec des majuscules</label>
        </div>

        <div class="form-group">
          <input name="withSpecial" type="checkbox" id="checkbox_speciaux">
          <label for="withSpecial">Avec des caractères spéciaux</label>
        </div>

        <div class="form-group">
          <input name="withInt" type="checkbox" id="checkbox_int">
          <label for="withInt">Avec des caractères chiffres</label>
        </div>
      </div>
      <div class="col-md">
        <div class="form-group">
          <label for="gen_mdp">Votre mot de passe : </label>
          <input type="text" id="generate_password" name="gen_mdp" class="form-control">
        </div>
        <div class="form-group">
          <input type="button" onclick="generatePassword()" value="Valider" class="btn btn-info">
        </div>
      </div>
    </div>

@endsection


@section('scripts')
{{-- Script pour générer un mot de passe aléatoire --}}
<script type="text/javascript">
function generatePassword(){
  // Les listes
  var ListeCar =  ["a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","w","x","y","z"];
  var ListeCarMaj = ["A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z"];
  var ListeNb = ["0","1","2","3","4","5","6","7","8","9"];
  var ListeCarSpeciaux = ["&","-","_","/","$","(",")","é","!","?","+","%"];
  var ListeFinale = ListeCar;
  // Récupération de la valeur du combo
  select = document.getElementById("comboNbCaract");
  choice = select.selectedIndex;  // Récupération de l'index du <option> choisi
  nbCaract = select.options[choice].value; // Récupération du texte du <option> d'index "choice"

  // Si on veut des majuscules
  if(document.getElementById("checkbox_majuscules").checked == true){
    for (var i = 0; i < ListeCarMaj.length; i++) {
      ListeFinale.push(ListeCarMaj[i]);
    }
  }
  //Si on veut des caractères spéciaux
  if(document.getElementById("checkbox_speciaux").checked == true){
    for (var i = 0; i < ListeCarSpeciaux.length; i++) {
      ListeFinale.push(ListeCarSpeciaux[i]);
    }
  }
  // Si on veut des chiffres
  if(document.getElementById("checkbox_int").checked == true){
    for (var i = 0; i < ListeNb.length; i++) {
      ListeFinale.push(ListeNb[i]);
    }
  }

  var chaine = "";
  for(i = 0; i < nbCaract; i++)
  {
    chaine = chaine + ListeFinale[Math.floor(Math.random()*ListeCar.length)];
  }
  document.getElementById("generate_password").value = chaine;

}
</script>
@endsection
