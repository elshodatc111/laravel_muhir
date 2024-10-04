<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{
    public function up(): void{
        Schema::create('bolims', function (Blueprint $table) {
            $table->id();
            $table->integer('coato');
            $table->string('name');
            $table->string('about');
            $table->timestamps();
        });
    }

    public function down(): void{
        Schema::dropIfExists('bolims');
    }
};
