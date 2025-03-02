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
    Schema::create('favories', function (Blueprint $table) {
        $table->id();
        $table->foreignId('id_touriste')->constrained('users')->onDelete('cascade');
        $table->foreignId('id_annonce')->constrained('annonce')->onDelete('cascade');
        $table->timestamps();
    });
}

public function down()
{
    Schema::dropIfExists('favories');
}

};
