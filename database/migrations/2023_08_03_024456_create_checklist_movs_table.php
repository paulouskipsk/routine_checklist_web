<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('checklists_movs', function (Blueprint $table) {
            $table->id();
            $table->string('description', 150)->nullable(false);
            $table->time('generate_time')->nullable(false);
            $table->integer('shelflife')->nullable(false);
            $table->string('frequency',3)->nullable(false);
            $table->string('frequency_composition',150)->nullable(false);
            $table->string('status', 1)->nullable(false);
            $table->string('is_free', 1)->nullable('S')->nullable(false);
            $table->timestamp('start_date')->nullable(false);
            $table->timestamp('end_date')->nullable(false);
            $table->integer('user_id')->nullable(true);
            $table->integer('chkl_id')->nullable(false);
            $table->integer('chcl_id')->nullable(true);
            $table->integer('unit_id')->nullable(false);

            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('chcl_id')->references('id')->on('chkl_classifications');
            $table->foreign('unit_id')->references('id')->on('units');
            $table->foreign('chkl_id')->references('id')->on('checklists');
        });
    }

    public function down(): void {
        Schema::dropIfExists('checklists_movs');
    }
};
