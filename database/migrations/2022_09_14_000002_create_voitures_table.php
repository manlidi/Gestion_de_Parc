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
        Schema::create('voitures', function (Blueprint $table) {
            $table->id();
            $table->string('marque');
            $table->integer('capacite');
            $table->string('immatriculation')->unique();
            $table->date('datdebservice');
            $table->integer('numchassis');
            $table->string('etat');
            $table->integer('kilmax')->default(0);
            $table->string('connsommation');
            $table->integer('coutaquisition');
            $table->string('mouvement')->default('Au parc');
            $table->string('dispo')->default('Disponible');
            $table->date('date_next_visite');
            $table->integer('kmvidange')->default(0);
            $table->boolean('status_visite')->default(false);
            $table->boolean('status_vidange')->default(false);
            $table->foreignId('structure_id')->constrained();
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
        Schema::dropIfExists('voitures');
    }
};
