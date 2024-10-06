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
        Schema::create('zodiacsigns', function (Blueprint $table) {
            $table->id();
            $table->string('zodiacn', 255);
            $table->date('startDate')->nullable();
            $table->date('endDate')->nullable();
            $table->text('characteristics')->nullable();
            $table->text('element')->nullable();
            $table->text('rulingPlanet')->nullable();
            $table->text('symbol')->nullable();
            $table->text('compatibility')->nullable();
            $table->text('ZodiacSign')->nullable();
            $table->text('PhysicalTraits')->nullable();
            $table->text('Interests')->nullable();
            $table->text('PersonalityTraits')->nullable();
            $table->text('ProfessionalLife')->nullable();

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
        Schema::dropIfExists('zodiacsigns');
    }
};
