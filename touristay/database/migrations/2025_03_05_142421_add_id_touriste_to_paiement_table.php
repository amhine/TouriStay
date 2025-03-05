<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIdTouristeToPaiementTable extends Migration
{
    public function up()
    {
        Schema::table('paiement', function (Blueprint $table) {
            $table->foreignId('id_touriste')->constrained('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('paiement', function (Blueprint $table) {
            $table->dropColumn('id_touriste');
        });
    }
}
