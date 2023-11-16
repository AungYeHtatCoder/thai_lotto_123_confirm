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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('profile', 2000)->nullable();
            $table->string('profile_mime')->nullable();
            $table->integer('profile_size')->nullable();
            $table->string('phone')->nullable()->default('N/A');
            $table->string('address')->nullable();
            $table->string('kpay_no')->nullable()->default('N/A');
            $table->string('cbpay_no')->nullable()->default('N/A');
            $table->string('wavepay_no')->nullable()->default('N/A');
            $table->string('ayapay_no')->nullable()->default('N/A');
            $table->integer('balance')->default(50000);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};