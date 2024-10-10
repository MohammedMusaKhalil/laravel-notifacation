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
        Schema::create('sent_messages', function (Blueprint $table) {
            $table->uuid('id')->primary(); // المفتاح الأساسي باستخدام UUID
            $table->text('message'); // الرسالة الأصلية
            $table->text('message_ar'); // الرسالة المترجمة للعربية
            $table->text('message_en'); // الرسالة المترجمة للإنجليزية
            $table->text('message_fr'); // الرسالة المترجمة للفرنسية
            $table->text('message_de'); // الرسالة المترجمة للألمانية
            $table->dateTime('notification_date'); // تاريخ الإشعار
            $table->boolean('is_for_all')->default(false); // هل الرسالة للجميع؟
            $table->unsignedBigInteger('user_id')->nullable(); // معرف المستخدم إذا كانت الرسالة لشخص معين
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); // ربط بمعرف المستخدم
            $table->timestamps(); // وقت الإنشاء والتحديث
        });
    }

    public function down()
    {
        Schema::dropIfExists('sent_messages');
    }

};
