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
        Schema::create('campaign_categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title', 100)->nullable();
            $table->string('photo', 100)->nullable();
            $table->longText('description')->nullable();
            $table->string('icon', 100)->nullable();
            $table->string('status', 15)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('campaign_categories');
    }
};
