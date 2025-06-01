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
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('wisata_id')->constrained('tempat_wisata')->onDelete('cascade');
            $table->date('tanggal_booking');
            $table->integer('jumlah_tiket');
            $table->decimal('total_bayar', 10, 2);
            $table->enum('status_pembayaran', ['pending', 'selesai'])->default('pending');
            $table->enum('status_tiket', ['belum_digunakan', 'sudah_digunakan'])->default('belum_digunakan');
            $table->text('qr_code_path');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};
