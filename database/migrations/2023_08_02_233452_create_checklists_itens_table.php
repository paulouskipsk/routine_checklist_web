<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void {
        Schema::create('checklists_itens', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('description', 200)->nullable(false);
            $table->integer('sequence')->nullable(false);
            $table->integer('score')->default(1)->nullable(false);
            $table->string('status', 1)->nullable(false);
            $table->string('type', 1)->nullable(false);
            $table->time('hour_min')->default(null);
            $table->time('hour_max')->default(null);
            $table->integer('shelflife');
            $table->boolean('required_photo')->default(false);
            $table->boolean('contain_action_plan')->default(false);
            $table->integer('chkl_id')->nullable(false);
            $table->integer('sect_id')->nullable(true);
            $table->integer('changed_by_user')->nullable(false);

            $table->timestamps();

            $table->foreign('chkl_id')->references('id')->on('checklists');
            $table->foreign('sect_id')->references('id')->on('sectors');
            $table->foreign('changed_by_user')->references('id')->on('users');
            $table->unique(['id', 'sequence']);
        });
    }

    public function down(): void {
        Schema::dropIfExists('checklists_itens');
    }
};
