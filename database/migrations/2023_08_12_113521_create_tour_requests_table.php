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
            $table->bigInteger('user_id');
            $table->string('company_name'); //نام شرکت
            $table->bigInteger('exhibition_id'); //آی دی نمایشگاه
            $table->string('exhibition_title', 255); //عنوان نمایشگاه
            $table->bigInteger('country'); //آی دی کشور
            $table->string('country_title', 150); //عنوان کشور
            $table->bigInteger('city'); //آی دی شهر
            $table->string('city_title', 150); //عنوان شهر
            $table->string('mobile', 15); //شماره تماس
            $table->integer('participants')->nullable(); //تعداد شرکت کنندگان
            $table->string('email'); //ایمیل
            $table->string('manager')->nullable(); //نام و نام خانوادگی مدیرعامل
            $table->string('responsible', 100); //نام و نام خانوادگی ثبت کننده
            $table->string('tracking_code'); //کد رهگیری
            $table->bigInteger('activity_area')->nullable();
            $table->string('activity_area_title', 255)->nullable();
            $table->bigInteger('operator_id')->nullable();
            $table->string('status', 15)->default('pending');
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
