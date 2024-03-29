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
        Schema::create('mission_users', function (Blueprint $table) {
            $table->id();
            $table->double('kmdeb')->default(0);
            $table->double('kmfin')->default(0);
            $table->foreignId('mission_id')->constrained()->onDelete('cascade');
            $table->foreignId('voiture_id')->nullable()->default(NULL)->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->default(NULL)->constrained()->onDelete('cascade');
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
        Schema::dropIfExists('mission_users');
    }
};
