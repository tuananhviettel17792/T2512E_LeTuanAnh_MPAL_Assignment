<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bank_accounts', function (Blueprint $table) {
            $table->id();
            $table->string('account_number', 10)->unique();
            $table->string('full_name', 100);
            $table->string('email', 100)->unique();
            $table->string('phone', 10)->nullable();
            $table->bigInteger('balance')->default(0);
            $table->enum('status', ['active', 'inactive', 'banned'])->default('active');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bank_accounts');
    }
};
