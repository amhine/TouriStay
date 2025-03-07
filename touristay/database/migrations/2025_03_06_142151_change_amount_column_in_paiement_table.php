<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeAmountColumnInPaiementTable extends Migration
{
    public function up()
    {
        Schema::table('paiement', function (Blueprint $table) {
            // Changer le type de la colonne 'amount' de INTEGER à DECIMAL
            $table->decimal('amount', 8, 2)->change();  // 8 chiffres au total, 2 après la virgule
        });
    }

    public function down()
    {
        Schema::table('paiement', function (Blueprint $table) {
            // Si vous devez revenir en arrière, restaurer la colonne en INTEGER
            $table->integer('amount')->change();
        });
    }
}
