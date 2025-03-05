<?php

// Exemple de migration pour la table 'equipement'
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEquipementTable extends Migration
{
    public function up()
    {
        Schema::create('equipement', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('icon');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('equipement');
    }
}
