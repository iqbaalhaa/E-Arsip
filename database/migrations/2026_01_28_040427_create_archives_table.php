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
        Schema::create('archives', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('category');
            $table->date('document_date');
            $table->string('fiscal_year');
            $table->enum('type', ['Laporan', 'Gambar Teknis', 'Surat']);
            $table->string('file_path');
            $table->enum('status', ['aktif', 'arsip', 'rahasia'])->default('aktif');
            $table->text('description')->nullable();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('archives');
    }
};
