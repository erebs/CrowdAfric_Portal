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
        Schema::create('campaigns', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('cat_id');
            $table->string('title', 100)->nullable();
            $table->string('photo', 100)->nullable();
            $table->longText('description')->nullable();
            $table->longText('content1')->nullable();
            $table->longText('content2')->nullable();
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
        Schema::dropIfExists('campaigns');
    }
};
