<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('weekly_horoscope_translations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('weekly_id');
            $table->unsignedBigInteger('zodiacsign_id');
            $table->unsignedBigInteger('language_id');
            $table->text('generalPrediction');
            $table->text('lovePrediction');
            $table->text('financialPrediction');
            $table->text('healthPrediction');
            $table->string('warnings');
            $table->timestamps();

            // // Foreign keys
            // $table->foreign('weekly_id')->references('id')->on('weeklies')->onDelete('cascade');
            // $table->foreign('zodiacsign_id')->references('id')->on('zodiacsigns')->onDelete('cascade');
            // $table->foreign('language_id')->references('id')->on('languages')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('weekly_horoscope_translations');
    }
};
