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
            $table->text('message_ar')->nullable(); // رسالة باللغة العربية
            $table->text('message_en')->nullable(); // رسالة باللغة الإنجليزية
            $table->text('message_fr')->nullable(); // رسالة باللغة الفرنسية
            $table->text('message_de')->nullable(); // رسالة باللغة الألمانية
            $table->date('notification_date');
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
