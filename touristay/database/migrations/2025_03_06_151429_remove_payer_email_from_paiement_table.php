<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemovePayerEmailFromPaiementTable extends Migration
{
    /**
     * Exécute la migration.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('paiement', function (Blueprint $table) {
            $table->dropColumn('payer_email');
        });
    }

    /**
     * Inverse la migration.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('paiement', function (Blueprint $table) {
            $table->string('payer_email')->nullable(); // Recréer la colonne si nécessaire
        });
    }
}
