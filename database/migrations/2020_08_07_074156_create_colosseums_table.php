<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateColosseumsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('colosseums', function (Blueprint $table) {
            $table->id();
            $table->string('rival');
            $table->enum('outcome', ['Victory', 'Defeat']);
            $table->integer('lifeforce_our')->nullable();
            $table->integer('lifeforce_theirs')->nullable();
            $table->date('colosseum_date')->nullable();
            $table->enum('colosseum_type', ['Colosseum', 'Grand Colosseum', 'Blood Colosseum'])->default('Colosseum')->nullable();
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
        Schema::dropIfExists('colosseums');
    }
}
