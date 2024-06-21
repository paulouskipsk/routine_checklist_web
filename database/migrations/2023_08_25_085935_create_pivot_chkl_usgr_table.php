<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void {
        Schema::create('pivot_chkl_usgr', function (Blueprint $table) {
            $table->id();
            $table->integer('chkl_id')->nullable(false);
            $table->integer('usgr_id')->nullable(false);
            $table->timestamps();

            $table->foreign('usgr_id')->references('id')->on('users_groups')->cascadeOnDelete();
            $table->foreign('chkl_id')->references('id')->on('checklists')->cascadeOnDelete();
            $table->unique(['usgr_id', 'chkl_id']);
        });
    }

    public function down(): void {
        Schema::dropIfExists('pivot_chkl_usgr');
    }
};
