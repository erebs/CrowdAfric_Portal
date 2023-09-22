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
        Schema::create('funding_faces', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('fund_id',5)->nullable();
            $table->string('title',100)->nullable();
            $table->string('amount',5)->nullable();
            $table->date('date')->nullable();
            $table->string('status',10)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('funding_faces');
    }
};
