<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->mediumIncrements('id');
            $table->string('name', 100)->nullable(false);
            $table->string('lastname', 200);
            $table->string('email');
            $table->string('login', 20)->nullable(false);
            $table->string('password', 64)->nullable(false);
            $table->string('status',1)->default('I')->nullable(false);
            $table->string('access_admin',1)->default('N');
            $table->string('access_mobile',1)->default('N');
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
