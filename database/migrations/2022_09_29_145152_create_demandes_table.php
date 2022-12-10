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
            $table->text('description');
            $table->boolean('addchauffeur')->default(false);
            $table->date('datedeb')->nullable()->default(NULL);
            $table->date('datefin')->nullable()->default(NULL);
            $table->string('type');
            $table->integer('nbreVoiture')->nullable();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('status')->default('Non Approuvée');
            $table->boolean('etat')->default(0);
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
