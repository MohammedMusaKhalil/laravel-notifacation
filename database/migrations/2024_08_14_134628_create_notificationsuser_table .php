<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('notificationsuser', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('type')->default('App\\Notifications\\UserRegisterNotification'); // إضافة قيمة افتراضية
            $table->morphs('notifiable');
            $table->text('data');
            $table->timestamp('notification_date')->useCurrent();
            $table->timestamp('read_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('notificationsuser', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }

};
