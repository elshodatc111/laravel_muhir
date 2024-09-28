<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{
    public function up(): void{
        Schema::create('bolims', function (Blueprint $table) {
            $table->id();
            $table->integer('coato')->unique();
            $table->string('name')->unique();
            $table->string('status')->default('true');
            $table->timestamps();
        });
    }

    public function down(): void{
        Schema::dropIfExists('bolims');
    }
};
