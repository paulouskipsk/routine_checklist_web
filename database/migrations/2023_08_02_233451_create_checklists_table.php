<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    
    public function up(): void {
        Schema::create('checklists', function (Blueprint $table) {
            $table->id();
            $table->integer('changed_by_user')->nullable(false);
            $table->integer('chcl_id')->nullable(true);
            $table->String('description', 150)->nullable(false);
            $table->time('generate_time')->nullable(false);
            $table->integer('shelflife')->nullable(false);
            $table->string('frequency', 3)->nullable(false);
            $table->string('frequency_composition', 150)->nullable(true);
            $table->string('status', 1)->nullable(false);
            $table->string('chkl_type', 1)->nullable(false);

            $table->timestamps();

            $table->foreign('changed_by_user')->references('id')->on('users');
            $table->foreign('chcl_id')->references('id')->on('chkl_classifications');
        });
    }

    public function down(): void {
        Schema::dropIfExists('checklists');
    }
};
