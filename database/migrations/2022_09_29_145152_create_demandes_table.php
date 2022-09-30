<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('demandes', function (Blueprint $table) {
            $table->id();
            $table->string('objetdemande');
            $table->date('datedeb');
            $table->date('datefin');
            $table->foreignId('voiture_id')->constrained()->onDelete('cascade');
            $table->foreignId('chauffeur_id')->constrained()->onDelete('cascade')->nullable()->default(NULL);
            $table->foreignId('user_id')->constrained()->onDelete('cascade')->nullable()->default(NULL);
            $table->string('status')->default('Non Approuvée');
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
        Schema::dropIfExists('demandes');
    }
};
