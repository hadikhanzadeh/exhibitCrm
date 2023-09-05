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
        Schema::create('booth_reserves', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->nullable();
            $table->string('company_name'); // نام شرکت
            $table->bigInteger('exhibition_id'); //آی دی نمایشگاه
            $table->string('exhibition_title', 255); //عنوان نمایشگاه
            $table->bigInteger('country'); //آی دی کشور
            $table->string('country_title', 150); //عنوان کشور
            $table->bigInteger('city'); //آی دی شهر
            $table->string('city_title', 150); //عنوان شهر
            $table->bigInteger('activity_area')->nullable();
            $table->string('activity_area_title', 255)->nullable();
            $table->string('manager_name')->nullable(); // نام و نام خانوادگی مدیر عامل
            $table->string('responsible')->nullable(); // نام و نام خانوادگی مسئول پیگیری
            $table->string('mobile_phone', 11); //  شماره تماس
            $table->string('email'); //  ایمیل
            $table->text('website')->nullable(); // ادرس وبسایت
            $table->tinyInteger('meterage_booth'); // متراژ غرفه
            $table->string('dimensions_booth'); //ابعاد غرفه
            $table->string('need_building')->default('0');
            $table->string('tracking_code'); //کد رهگیری
            $table->bigInteger('operator_id')->nullable();
            $table->string('status', 15)->default('pending');
            $table->string('lang', 5)->default('fa');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booth_reserves');
    }
};
