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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('phone')->nullable();
            $table->string('country')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->enum('gender', ['Male', 'Female', 'Other'])->nullable();
            $table->integer('status')->default(1);
            $table->datetime('registration_date')->nullable();
            $table->datetime('last_login_at')->nullable();
            $table->tinyInteger('email_confirmed')->default(0);
            $table->string('personality')->nullable();
            $table->time('email_verified_at')->nullable();
            $table->boolean('notifications_disabled')->default(1);
            $table->boolean('notifications_in_watsapp')->default(0);
            $table->rememberToken();
            $table->string('google_id')->nullable();
            $table->string('google_token')->nullable();
            $table->string('google_refresh_token')->nullable();
            // مفاتيح خارجية للجداول المرتبطة (يمكن حذفها إذا كنت تستخدم جداول الربط)
            $table->unsignedBigInteger('zodiac_sign_id')->nullable();
            $table->unsignedBigInteger('language_id')->default(2);

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
        Schema::dropIfExists('users');
    }
};
