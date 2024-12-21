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
        Schema::create('assets', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nama asset
            $table->text('description')->nullable(); // Deskripsi asset
            $table->string('serial_number')->unique(); // Nomor seri unik
            $table->decimal('value', 15, 2); // Nilai asset
            $table->integer('loan_id')->nullable(); // Nama asset            
            $table->timestamps(); // Timestamps (created_at dan updated_at)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assets');
    }
};
