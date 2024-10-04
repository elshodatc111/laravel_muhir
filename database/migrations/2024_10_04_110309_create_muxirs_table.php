<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('muxirs', function (Blueprint $table) {
            $table->id();
            $table->integer('coato')->default(10400);
            $table->integer('number')->unique();
            $table->string('type')->default('null');
            $table->string('status')->default('null');
            $table->string('faktura')->default('null');
            $table->string('meneger');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('muxirs');
    }
};
