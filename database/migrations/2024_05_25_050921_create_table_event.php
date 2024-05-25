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
        Schema::create('table_event', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('nama_tl');
            $table->foreign('nama_tl')->references('id')->on('master_karyawan');
            $table->unsignedBigInteger('spg1');
            $table->foreign('spg1')->references('id')->on('master_karyawan');
            $table->unsignedBigInteger('spg2');
            $table->foreign('spg2')->references('id')->on('master_karyawan');
            $table->date('tanggal');
            $table->unsignedBigInteger('sku');
            $table->foreign('sku')->references('id')->on('master_sku');
            $table->integer('qty');
            $table->integer('harga_satuan');
            $table->integer('total_penjualan');
            $table->integer('target_penjualan');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_event');
    }
};
