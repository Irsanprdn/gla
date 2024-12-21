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
        Schema::create('bank_accounts', function (Blueprint $table) {
            $table->id(); // Primary Key
            $table->string('account_number'); // Account Number
            $table->string('account_name'); // Account Name
            $table->string('bank_name'); // Bank Name
            $table->string('branch_name')->nullable(); // Branch Name
            $table->decimal('balance', 15, 2)->default(0); // Balance
            $table->timestamps(); // Created_at & Updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bank_accounts');
    }
};
