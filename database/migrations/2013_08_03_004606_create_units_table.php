<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void {
        Schema::create('units', function (Blueprint $table) {
            $table->id();
            $table->string('fantasy_name')->nullable(false);
            $table->string('corporate_name')->nullable(true);
            $table->string('cnpj', 20)->nullable(true)->unique();
            $table->string('state_registration', 20)->nullable(true)->unique();
            $table->string('phone_fixed', 16)->nullable(true);
            $table->string('status', 1)->nullable(false);
            $table->integer('addr_id')->nullable(false);
            $table->timestamps();

            $table->foreign('addr_id')->references('id')->on('adresses');
            $table->index('cnpj');
            $table->index('fantasy_name');
            $table->index('state_registration');
        });
    }

    public function down(): void {
        Schema::dropIfExists('units');
    }
};
