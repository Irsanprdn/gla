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
        Schema::table('bank_accounts', function (Blueprint $table) {
            $table->dropColumn(['branch_name', 'balance']); // Menghapus kolom branch_name dan balance
            $table->unsignedBigInteger('bank_id')->after('account_name'); // Menambah kolom bank_id
            $table->dropColumn('bank_name'); // Menghapus kolom bank_name
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
