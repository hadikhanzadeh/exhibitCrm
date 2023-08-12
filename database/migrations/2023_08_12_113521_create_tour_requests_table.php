<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tour_requests', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->string('company_name'); //نام شرکت
            $table->bigInteger('exhibition_id'); //آی دی نمایشگاه
            $table->string('mobile', 15); //شماره تماس
            $table->integer('participants')->nullable(); //تعداد شرکت کنندگان
            $table->string('email'); //ایمیل
            $table->string('manager')->nullable(); //نام و نام خانوادگی مدیرعامل
            $table->string('tracking_code'); //کد رهگیری
            $table->bigInteger('activity_area')->nullable();
            $table->bigInteger('operator_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tour_requests');
    }
};
