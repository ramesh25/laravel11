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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('site_title')->nullable();
            $table->string('email')->nullable();
            $table->string('email_2')->nullable();
            $table->string('landline')->nullable();
            $table->string('landline_2')->nullable();
            $table->string('mobile_no')->nullable();
            $table->string('mobile_no_2')->nullable();
            $table->string('fax')->nullable();
            $table->mediumText('address')->nullable();
            $table->string('post_code')->nullable();
            $table->string('logo')->nullable();
            $table->string('favicon')->nullable();
            $table->longText('google_analytics')->nullable();
            $table->string('meta_title')->nullable();
            $table->mediumText('meta_keywords')->nullable();
            $table->longText('meta_description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
