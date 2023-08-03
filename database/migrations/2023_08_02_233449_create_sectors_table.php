<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void     {
        Schema::create('sectors', function (Blueprint $table) {
            $table->id();
            $table->string('description', 50)->nullable(false);
            $table->string('status', 1)->nullable(false);
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('sectors');
    }
};
