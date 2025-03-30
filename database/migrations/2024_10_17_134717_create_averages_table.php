<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('averages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('matakuliah_id')->constrained('matakuliahs')->onDelete('cascade');
            $table->integer('jumlah_mahasiswa')->nullable(); // Menghitung jumlah mahasiswa dalam matakuliah tertentu
            $table->float('average_quiz')->nullable();
            $table->float('average_tugas')->nullable();
            $table->float('average_uts')->nullable();
            $table->float('average_uas')->nullable();
            $table->float('average_total_nilai')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('averages');
    }
};
