<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{
    public function up(): void{
        Schema::create('muxir_fakturas', function (Blueprint $table) {
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

    public function down(): void{
        Schema::dropIfExists('muxir_fakturas');
    }
};
