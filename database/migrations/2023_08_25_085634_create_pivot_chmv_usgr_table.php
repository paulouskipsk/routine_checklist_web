<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void {
        Schema::create('pivot_chmv_usgr', function (Blueprint $table) {
            $table->id();
            $table->integer('chmv_id')->nullable(false);
            $table->integer('usgr_id')->nullable(false);
            $table->timestamps();

            $table->foreign('usgr_id')->references('id')->on('users_groups');
            $table->foreign('chmv_id')->references('id')->on('checklists_movs');
            $table->unique(['usgr_id', 'chmv_id']);
        });
    }

    public function down(): void {
        Schema::dropIfExists('pivot_chmv_usgr');
    }
};
