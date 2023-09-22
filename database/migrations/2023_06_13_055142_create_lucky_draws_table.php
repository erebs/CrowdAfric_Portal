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
        Schema::create('lucky_draws', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('campaign_id',5)->nullable();
            $table->string('user_id',5)->nullable();
             $table->string('application_id',5)->nullable();
            $table->string('status',10)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lucky_draws');
    }
};
