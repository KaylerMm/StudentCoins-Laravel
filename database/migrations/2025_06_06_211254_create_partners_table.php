<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('partners', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('empresa_nome');
            $table->string('cnpj')->unique();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('partners');
    }
};
