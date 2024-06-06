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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('namaPemesan');
            $table->string('noHp');
            $table->dateTime('waktuMulai');
            $table->dateTime('waktuSelesai');
            $table->integer('hargaTotal');
            $table->string('status')->default('Menunggu Persetujuan');
            $table->unsignedBigInteger('lapangan_id'); // pastikan ini adalah unsignedBigInteger
            $table->foreign('lapangan_id')->references('id')->on('lapangans')->onDelete('cascade');
            $table->unsignedBigInteger('lokasi_id'); // pastikan ini adalah unsignedBigInteger
            $table->foreign('lokasi_id')->references('id')->on('lokasis')->onDelete('cascade');
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
