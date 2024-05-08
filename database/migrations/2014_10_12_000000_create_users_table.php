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
            $table->string('lastname', 200)->nullable(true);
            $table->string('email')->nullable(true);
            $table->string('login', 20)->nullable(false);
            $table->string('password', 64)->nullable(true);
            $table->string('status',1)->default('I')->nullable(false);
            $table->string('access_admin',1)->default('N')->nullable(false);
            $table->string('access_mobile',1)->default('N')->nullable(false);
            $table->string('access_operator',1)->default('N')->nullable(false);
            $table->timestamp('email_verified_at')->nullable();
            $table->integer('unity_logged')->nullable(true);
            $table->timestamps();
            $table->rememberToken();

            $table->foreign('unity_logged')->references('id')->on('units');

            $table->index('login');
            $table->index('name');
            $table->index('email');
        });
    }

    public function down(): void {
        Schema::dropIfExists('users');
    }
};
