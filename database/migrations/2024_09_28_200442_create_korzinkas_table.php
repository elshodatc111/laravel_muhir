<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{
    public function up(): void{
        Schema::create('korzinkas', function (Blueprint $table) {
            $table->id();
            $table->integer('number')->unique();
            $table->integer('coato');
            $table->string('fio');
            $table->string('opertor');
            $table->integer('count');
            $table->string('scanner')->default('null');
            $table->string('scanner_url')->default('null');
            $table->timestamps();
        });
    }
    public function down(): void{
        Schema::dropIfExists('korzinkas');
    }
};
