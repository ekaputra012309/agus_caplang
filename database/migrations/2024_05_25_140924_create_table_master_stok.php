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
        Schema::create('table_master_stok', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('spg_id');
            $table->foreign('spg_id')->references('id')->on('master_karyawan');
            $table->string('area');
            $table->unsignedBigInteger('outlet_id');
            $table->foreign('outlet_id')->references('id')->on('master_outlet');
            $table->unsignedBigInteger('sku');
            $table->foreign('sku')->references('id')->on('master_sku');
            $table->integer('stok');
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
        Schema::dropIfExists('table_master_stok');
    }
};
