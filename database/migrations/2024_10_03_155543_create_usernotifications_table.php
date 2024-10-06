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
        Schema::create('usernotifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('userId')->constrained('users')->onDelete('cascade');  // علاقة مع جدول الأعضاء
            $table->tinyInteger('enableDailyHoroscope')->default(0);
            $table->tinyInteger('enableWeeklyHoroscope')->default(0);
            $table->tinyInteger('enableMonthlyHoroscope')->default(0);
            $table->tinyInteger('enableDailyTips')->default(0);
            $table->tinyInteger('enableFinancialTips')->default(0);
            $table->tinyInteger('enableGirlsTips')->default(0);
            $table->tinyInteger('enableHealthTips')->default(0);
            $table->tinyInteger('enableMarriageTips')->default(0);
            $table->tinyInteger('enable_weekly')->nullable();
            $table->tinyInteger('enable_monthly')->nullable();
            $table->time('lastNotificationDate')->nullable();
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
        Schema::dropIfExists('usernotifications');
    }
};
