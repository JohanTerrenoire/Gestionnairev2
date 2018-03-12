<?php

use Illuminate\Database\Seeder;
use App\User;

class CombinaisonTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::first();
        $table = [
          [
            'Facebook',
            'terrenoirejohan@yahoo.fr',
            'www.facebook.com',
            'passBook',
            'Personnel'
          ],
          [
            'Outlook',
            'terrenoirejohan@oulook.com',
            'www.outlook.com',
            'passLook',
            'Professionnel'
          ],
          [
            'Banque CIC',
            'terrenoirejohan@yahoo.fr',
            'www.cic.fr',
            'passBanque',
            'Personnel'
          ]
        ];
        foreach ($table as $value) {
          $combinaison = new App\Combinaison();
          $combinaison->libelle = $value[0];
          $combinaison->identifiant = $value[1];
          $combinaison->url = $value[2];
          $combinaison->password = $value[3];
          $combinaison->page = $value[4];
          $combinaison->user()->associate($user);
          $combinaison->save();
          echo "Création de la combinaison ".$combinaison->id."\n";
        }
    }
}
