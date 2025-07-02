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
        Schema::create('navs', function (Blueprint $table) {
            $table->id();
            $table->integer('parent_id')->nullable();
            $table->string('title')->nullable();
            $table->string('url')->nullable();
            $table->string('type')->nullable();
            $table->integer('type_id')->nullable();
            $table->tinyInteger('is_dev')->nullable();
            $table->tinyInteger('target')->nullable();
            $table->tinyInteger('position')->nullable();
            $table->tinyInteger('publish')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('navs');
    }
};
