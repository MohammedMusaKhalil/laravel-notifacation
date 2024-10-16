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
        Schema::create('horoscope_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('daily_id')->constrained('dailies')->onDelete('cascade');
            $table->foreignId('Zodiacsign_id')->constrained()->onDelete('cascade'); // علاقة مع جدول الابراج
            $table->foreignId('language_id')->constrained()->onDelete('cascade');   // علاقة مع جدول اللغات
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
        Schema::dropIfExists('horoscope_translations');
    }
};
