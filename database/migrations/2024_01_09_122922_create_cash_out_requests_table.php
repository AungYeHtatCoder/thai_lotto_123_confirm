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
        Schema::create('cash_out_requests', function (Blueprint $table) {
            $table->id();
            $table->string('payment_method');
            $table->integer('amount');
            $table->string('currency');
            $table->string('phone');
            $table->string('name');
            $table->unsignedBigInteger('user_id');
            $table->tinyInteger('status')->default(0);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cash_out_requests');
    }
};