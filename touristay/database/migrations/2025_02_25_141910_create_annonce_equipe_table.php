<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   
    public function up()
    {
        Schema::create('annonce_equipe', function (Blueprint $table) {
            $table->unsignedBigInteger('annonce_id');
$table->unsignedBigInteger('equipe_id');

            
            $table->foreign('annonce_id')->references('id')->on('annonce')->onDelete('cascade');
            $table->foreign('equipe_id')->references('id')->on('equipement')->onDelete('cascade');
            
            $table->primary(['annonce_id', 'equipe_id']);
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('annonce_equipe');
    }
};
