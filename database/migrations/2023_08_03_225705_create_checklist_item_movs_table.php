<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void{
        Schema::create('checklists_itens_movs', function (Blueprint $table) {
            $table->id();
            $table->string('description', 150)->nullable(false);
            $table->smallInteger('sequence')->nullable(false);
            $table->smallInteger('score')->nullable(false);
            $table->time('hour_min', 8);
            $table->time('hour_max', 8);
            $table->boolean('required_photo')->default(false)->nullable(false);
            $table->boolean('contain_action_plan')->default(false)->nullable(false);
            $table->smallInteger('quant_photo')->default(0)->nullable(false);
            $table->string('status', 1)->nullable(false);;
            $table->string('observation', 150);
            $table->string('type', 3);
            $table->integer('shelflife');
            $table->timestamp('end_date')->nullable(false);
            $table->timestamp('start_date')->nullable(false);
            $table->string('response', 3);
            $table->integer('user_id');
            $table->integer('chit_id')->nullable(false);
            $table->integer('chmv_id')->nullable(false);
            $table->integer('sect_id');

            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('sect_id')->references('id')->on('sectors');
            $table->foreign('chit_id')->references('id')->on('checklists_itens');
            $table->foreign('chmv_id')->references('id')->on('checklists_movs');


        });
    }

    public function down(): void {
        Schema::dropIfExists('checklists_itens_movs');
    }
};
