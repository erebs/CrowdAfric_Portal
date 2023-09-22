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
        Schema::create('repayments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('user_id',5)->nullable();
            $table->string('application_id',5)->nullable();
            $table->string('amount',5)->nullable();
            $table->date('due_date')->nullable();
            $table->string('fine',5)->nullable();
            $table->string('status',10)->nullable();
            $table->date('paid_at')->nullable();
            $table->string('reference_id',200)->nullable();
            $table->string('pay_status',10)->nullable();
            $table->string('paid_amount',10)->nullable();
            $table->string('payment_approval',10)->nullable();
            $table->string('rejected_by',10)->nullable();
            $table->string('rejection_reason',300)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('repayments');
    }
};
