<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void{
        Schema::create('checklists_itens_movs', function (Blueprint $table) {
            $table->id();
            $table->string('description', 200)->nullable(false);
            $table->smallInteger('sequence')->nullable(true);
            $table->smallInteger('score')->nullable(false);
            $table->time('hour_min', 8)->nullable(true);
            $table->time('hour_max', 8)->nullable(true);
            $table->string('status', 1)->nullable(false);
            $table->string('type', 3)->nullable(true);
            $table->integer('shelflife')->nullable(false);
            $table->timestamp('end_date')->nullable(false);
            $table->timestamp('start_date')->nullable(false);
            $table->string('processed', 1)->default('N')->nullable(false);
            $table->timestamp('processed_in')->nullable(true);
            $table->string('response', 3)->nullable(true);
            $table->string('type_obs', 1)->default('N')->nullable(false);
            $table->string('observation', 150)->nullable(true);
            $table->string('required_photo', 1)->default('N')->nullable(false);
            $table->smallInteger('quant_photo')->default(0)->nullable(false);
            $table->integer('user_id')->nullable(true);
            $table->integer('chit_id')->nullable(true);
            $table->integer('chmv_id')->nullable(false);
            $table->integer('sect_id')->nullable(true);
            $table->json('photos')->nullable(true);

            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->nullOnDelete();
            $table->foreign('sect_id')->references('id')->on('sectors');
            $table->foreign('chit_id')->references('id')->on('checklists_itens')->nullOnDelete();
            $table->foreign('chmv_id')->references('id')->on('checklists_movs')->cascadeOnDelete();
        });
    }

    public function down(): void {
        Schema::dropIfExists('checklists_itens_movs');
    }
};
