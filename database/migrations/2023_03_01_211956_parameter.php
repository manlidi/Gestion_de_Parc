<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parameters', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('status')->default(true);
            $table->time('time')->default('09:00:00');
            $table->timestamps();
        });

        DB::table('parameters')->insert([
            'name' =>'piece'
        ]);
        DB::table('parameters')->insert([
            'name' =>'visite'
        ]);
        DB::table('parameters')->insert([
            'name' =>'assurance'
        ]);
        DB::table('parameters')->insert([
            'name' =>'vidange'
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('parameters');
    }
};
