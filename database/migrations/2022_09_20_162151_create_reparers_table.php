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
        Schema::create('reparers', function (Blueprint $table) {
            $table->id();
            $table->string('panne');
            $table->date('datereparation');
            $table->foreignId('garage_id')->constrained();
            $table->foreignId('voiture_id')->constrained();
            $table->foreignId('piece_id')->constrained();
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
        Schema::dropIfExists('reparers');
    }
};
