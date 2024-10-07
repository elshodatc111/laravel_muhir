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
        Schema::create('naryad_blanka_fakturas', function (Blueprint $table) {
            $table->id();
            $table->integer('number');
            $table->integer('coato');
            $table->string('coato_name');
            $table->integer('count');
            $table->string('hodim');
            $table->string('operator');
            $table->string('scanner');
            $table->string('scanner_url');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('naryad_blanka_fakturas');
    }
};
