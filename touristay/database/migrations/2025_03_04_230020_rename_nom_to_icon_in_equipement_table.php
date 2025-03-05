<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameNomToIconInEquipementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('equipement', function (Blueprint $table) {
            $table->renameColumn('nom', 'icon');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('equipement', function (Blueprint $table) {
            $table->renameColumn('icon', 'nom');
        });
    }
}
