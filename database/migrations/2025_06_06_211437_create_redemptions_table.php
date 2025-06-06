<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('redemptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('reward_id')->constrained('rewards')->onDelete('cascade');
            $table->enum('status', ['pendente', 'aprovado', 'recusado'])->default('pendente');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('redemptions');
    }
};
