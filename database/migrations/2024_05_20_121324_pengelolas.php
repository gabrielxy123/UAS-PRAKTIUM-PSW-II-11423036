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
        Schema::create('pengelolas', function (Blueprint $table) {
            $table->id();
            $table->string('namaPengelola');
            $table->string('username');
            $table->string('password');
            $table->unsignedBigInteger('lokasi_id'); // pastikan ini adalah unsignedBigInteger
            $table->foreign('lokasi_id')->references('id')->on('lokasis')->onDelete('cascade');
            $table->string('role')->default('pengelola');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengelolas');
    }
};
