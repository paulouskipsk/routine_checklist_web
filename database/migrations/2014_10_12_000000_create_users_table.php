<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->mediumIncrements('id');
            $table->string('name', 100);
            $table->string('lastname', 200);
            $table->string('email');
            $table->string('login', 20);
            $table->string('password', 64);
            $table->string('status',1)->default('I')->nullable(false);
            $table->boolean('access_admin')->default(false);
            $table->boolean('access_mobile')->default(false);
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamps();
            $table->rememberToken();

            $table->index('login');
        });
    }

    public function down(): void {
        Schema::dropIfExists('users');
    }
};
