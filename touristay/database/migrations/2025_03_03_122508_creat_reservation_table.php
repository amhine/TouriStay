<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
  
    public function up(): void
{
    Schema::create('reservation', function (Blueprint $table) {
        $table->id();
        $table->date('datedebut');
        $table->date('datefin');
        $table->string('status');
        $table->foreignId('annonce_id')->constrained('annonce')->onDelete('cascade');
        $table->timestamps();
    });
}
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
