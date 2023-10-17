<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void {
        Schema::create('adresses', function (Blueprint $table) {
            $table->id();
            $table->integer('city_id')->nullable(false);
            $table->string('street_name')->nullable(false);
            $table->integer('number')->nullable(false);
            $table->string('cep', 12)->nullable(false);
            $table->string('neighborhood')->nullable(false);
            $table->string('complement', 100)->nullable(true);
            $table->timestamps();

            $table->foreign('city_id')->references('id')->on('cities');
            $table->index('cep');
            $table->index('city_id');
            $table->index('neighborhood');
        });
    }

    public function down(): void {
        Schema::dropIfExists('adresses');
    }
};
