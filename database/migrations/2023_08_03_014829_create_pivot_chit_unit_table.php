<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('pivot_chit_unit_noapplicable', function (Blueprint $table) {
            $table->id();
            $table->integer('chit_id')->nullable(false);
            $table->integer('unit_id')->nullable(false);
            $table->timestamps();

            $table->foreign('unit_id')->references('id')->on('units');
            $table->foreign('chit_id')->references('id')->on('checklists_itens');
            $table->unique(['unit_id', 'chit_id']);
        });
    }

    public function down(): void {
        Schema::dropIfExists('pivot_chit_unit');
    }
};
