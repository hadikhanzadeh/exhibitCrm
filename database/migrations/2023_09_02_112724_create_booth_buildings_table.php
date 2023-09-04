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
        Schema::create('booth_buildings', function (Blueprint $table) {
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
            $table->string('mobile_phone', 11); //  شماره تماس
            $table->text('website')->nullable(); // ادرس وبسایت
            $table->string('email'); //  ایمیل
            $table->string('manager_name')->nullable(); // نام و نام خانوادگی مدیر عامل
            $table->string('responsible')->nullable(); // نام و نام خانوادگی مسئول پیگیری
            $table->tinyInteger('meterage_booth'); // متراژ غرفه
            $table->string('dimensions_booth'); //ابعاد غرفه
            $table->string('hall_name'); // نام سالن
            $table->text('hall_map')->nullable(); // نقشه سالن
            $table->text('corporate_color'); //رنگ سازمانی
            $table->text('logo')->nullable(); // لوگو سازمانی
            $table->string('showcase_product')->nullable(); //نوع نمایش محصولات ویترینی
            $table->text('equipment')->nullable(); // تجهیزات مورد نیاز
            $table->string('product_count')->nullable(); // تعداد محصول
            $table->string('product_type')->nullable(); // نوع محصول
            $table->string('product_dimensions')->nullable(); // ابعاد محصولات
            $table->smallInteger('answering_desks')->nullable(); // تعداد میز پاسخگویی
            $table->bigInteger('amount_budget')->nullable(); // میزان بوجه
            $table->string('height_booth')->nullable(); // ارتفاع غرفه
            $table->string('flower_arrangement')->nullable(); // نیاز به گل آرایی
            $table->string('design_type')->nullable(); // نوع طراحی
            $table->string('another_city')->nullable(); // خمات غرفه سازی در شهر دیگر
            $table->string('another_country')->nullable(); // خمات غرفه سازی خارج ایران
            $table->string('need_reserve')->default('false');
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
        Schema::dropIfExists('booth_buildings');
    }
};
