<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLiaisonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('liaisons', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('mail_partenaire');
            $table->integer('combinaison_id')->unsigned();
            $table->boolean('isEditable');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('mail_partenaire')->references('email')->on('users');
            $table->foreign('combinaison_id')->references('id')->on('combinaisons')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('liaisons');
    }
}
