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
        Schema::create('employees', function (Blueprint $table) {
            $table->id(); // Primary Key
            $table->string('name'); // Nama
            $table->string('email')->unique(); // Email
            $table->string('phone')->nullable(); // Nomor Telepon
            $table->string('address'); // alamat
            $table->string('position'); // Jabatan
            $table->decimal('salary', 15, 2)->nullable(); // Gaji
            $table->timestamps(); // Created_at & Updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
