<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdatePaiementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('paiement', function (Blueprint $table) {
            $table->string('payer_email');
            $table->string('status');
            $table->integer('amount');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('paiement', function (Blueprint $table) {
            $table->dropColumn(['reservation_id', 'datePaiement', 'id_touriste', 'payer_email', 'status', 'amount']);
        });
    }
}
