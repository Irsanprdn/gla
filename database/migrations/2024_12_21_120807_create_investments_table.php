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
        Schema::create('investments', function (Blueprint $table) {
            $table->id(); // Primary Key
            $table->string('name'); // Nama investasi
            $table->integer('investor_id'); // Nama investasi
            $table->decimal('amount', 15, 2); // Jumlah investasi
            $table->date('investment_date'); // Tanggal investasi
            $table->integer('duration_months'); // Durasi dalam bulan
            $table->decimal('rate_of_return', 5, 2); // Tingkat pengembalian (%)
            $table->timestamps(); // Created at & Updated at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('investments');
    }
};
