<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{
    public function up(): void{
        Schema::create('muxirs', function (Blueprint $table) {
            $table->id();
            $table->string('number')->unique();
            $table->string('operator');
            $table->string('type')->default('new');
            $table->string('number_id');
            $table->timestamps();
        });
    }
    public function down(): void{
        Schema::dropIfExists('muxirs');
    }
};
