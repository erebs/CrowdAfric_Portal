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
        Schema::table('users', function (Blueprint $table) {
            $table->string('age',5)->nullable();
            $table->string('address',700)->nullable();
            $table->integer('country_id')->nullable();
            $table->integer('state_id')->nullable();
            $table->string('town',100)->nullable();
            $table->string('post_code',30)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
             $table->dropColumn('age');
             $table->dropColumn('address');
             $table->dropColumn('country_id');
             $table->dropColumn('state_id');
             $table->dropColumn('town');
        });
    }
};
