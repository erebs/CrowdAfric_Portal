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
        Schema::create('fundings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('user_id',5)->nullable();
            $table->string('application_id',5)->nullable();
            $table->string('amount',5)->nullable();
            $table->string('month',5)->nullable();
            $table->string('month_interest',5)->nullable();
            $table->string('total_interest',5)->nullable();
            $table->string('total_amount',5)->nullable();
            $table->string('status',10)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fundings');
    }
};
