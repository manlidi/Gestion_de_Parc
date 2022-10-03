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
            $table->integer('dureeVie');
            $table->integer('numchassis');
            $table->string('etat');
            $table->integer('kilmax');
            $table->string('connsommation');
            $table->integer('coutaquisition');
            $table->string('mouvement')->default('Au parc');
            $table->string('dispo')->default('Disponible');
            $table->date('date_last_visite')->default(NULL);
            $table->boolean('status_visite')->default(false);
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
