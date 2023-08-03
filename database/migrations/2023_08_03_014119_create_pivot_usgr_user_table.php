<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    
    public function up(): void {
        Schema::create('pivot_usgr_user', function (Blueprint $table) {
            $table->id();
            $table->integer('usgr_id')->nullable(false);
            $table->integer('user_id')->nullable(false);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('usgr_id')->references('id')->on('users_groups');
            $table->unique(['user_id', 'usgr_id']);
        });
    }

    public function down(): void {
        Schema::dropIfExists('pivot_usgr_user');
    }
};
