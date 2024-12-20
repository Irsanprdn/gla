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
        Schema::create('programs', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('route');
            $table->string('description')->nullable();
        
            // Add parent_id to establish a relationship with other programs
            $table->foreignId('parent_id')->nullable()->constrained('programs')->onDelete('cascade');
        
            // Add status to indicate whether the program is active or not
            $table->enum('status', ['active', 'inactive'])->default('active');
        
            // Add type to specify whether the program is a parent or child
            $table->enum('type', ['parent', 'child'])->default('parent');
            
            $table->timestamps();
        });
        
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('programs');
    }
};
