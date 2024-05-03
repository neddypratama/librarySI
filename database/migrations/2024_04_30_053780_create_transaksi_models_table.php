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
        Schema::create('t_transaksi', function (Blueprint $table) {
            $table->id('transaksi_id');
            $table->string('transaksi_kode')->unique();
            $table->unsignedBigInteger('user_id')->index();
            $table->unsignedBigInteger('buku_id')->index();
            $table->date('tgl_peminjaman');
            $table->date('tgl_pengembalian')->nullable();
            $table->integer('denda');
            $table->timestamps();

            $table->foreign('user_id')->references('user_id')->on('m_user');
            $table->foreign('buku_id')->references('buku_id')->on('m_buku');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_transaksis');
    }
};
