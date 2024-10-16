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
        Schema::create('monthly_horoscope_translations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('monthly_id');
            $table->unsignedBigInteger('zodiacsign_id');
            $table->unsignedBigInteger('language_id');
            $table->text('generalPrediction');
            $table->text('lovePrediction');
            $table->text('financialPrediction');
            $table->text('healthPrediction');
            $table->integer('Finanzial_per');
            $table->integer('health');
            $table->integer('loveLife');
            $table->integer('occupat_per');
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
        Schema::dropIfExists('monthly_horoscope_translations');
    }
};
