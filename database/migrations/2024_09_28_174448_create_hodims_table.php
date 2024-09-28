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
        Schema::create('hodims', function (Blueprint $table) {
            $table->id();
            $table->integer('coato');
            $table->string('fio');
            $table->string('phone');
            $table->string('lavozim');
            $table->string('status')->default('true');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hodims');
    }
};
