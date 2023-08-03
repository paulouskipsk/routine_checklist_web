<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('states', function (Blueprint $table) {
            $table->id();
            $table->string('name', 30)->nullable(false);
            $table->string('scronym', 2)->nullable(false);
            $table->string('status', 1)->nullable(false);
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('states');
    }
};
