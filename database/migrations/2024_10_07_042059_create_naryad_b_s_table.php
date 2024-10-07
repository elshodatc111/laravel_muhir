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
        Schema::create('naryad_b_s', function (Blueprint $table) {
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

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('naryad_b_s');
    }
};
