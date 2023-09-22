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
        Schema::create('applications', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('user_id',5)->nullable();
            $table->string('campaign_id',5)->nullable();
            $table->string('plan',500)->nullable();
            $table->string('location',100)->nullable();
            $table->string('address',300)->nullable();
            $table->string('post',100)->nullable();
            $table->string('local_area',100)->nullable();
            $table->string('country_id',5)->nullable();
            $table->string('state_id',5)->nullable();
            $table->string('plot',100)->nullable();
            $table->string('annual_turnover',10)->nullable();
            $table->string('payment_status',10)->nullable();
            $table->string('amount',10)->nullable();
            $table->dateTime('payment_date')->nullable();
            $table->string('reference_id',150)->nullable();
            $table->string('nominee1',50)->nullable();
            $table->string('mobile1',15)->nullable();
            $table->string('nominee2',50)->nullable();
            $table->string('mobile2',15)->nullable();
            $table->string('nominee3',50)->nullable();
            $table->string('mobile3',15)->nullable();
            $table->string('nominee4',50)->nullable();
            $table->string('mobile4',15)->nullable();
            $table->string('nominee5',50)->nullable();
            $table->string('mobile5',15)->nullable();
            $table->string('status', 10)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};
