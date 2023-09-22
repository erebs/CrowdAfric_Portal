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
        Schema::create('lucky_draw_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('campaign_id',5)->nullable();
            $table->string('title',5)->nullable();
            $table->string('winners',5)->nullable();
            $table->string('country',5)->nullable();
            $table->string('state',5)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lucky_draw_items');
    }
};
