<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void {
        Schema::create('checklists_itens', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('description', 200)->nullable(false);
            $table->smallInteger('sequence')->nullable(true);
            $table->smallInteger('score')->default(1)->nullable(false);
            $table->string('status', 1)->nullable(false);
            $table->string('type', 1)->nullable(false);
            $table->time('hour_min')->default(null);
            $table->time('hour_max')->default(null);
            $table->bigInteger('shelflife');
            $table->string('type_obs', 1)->default('N')->nullable(false);
            $table->string('required_photo', 1)->default('N');
            $table->smallInteger('quant_photo')->default(0)->nullable(false);
            $table->integer('chkl_id')->nullable(false);
            $table->integer('sect_id')->nullable(true);
            $table->integer('changed_by_user')->nullable(false);
            
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('chkl_id')->references('id')->on('checklists')->cascadeOnDelete();
            $table->foreign('sect_id')->references('id')->on('sectors');
            $table->foreign('changed_by_user')->references('id')->on('users');
            // $table->unique(['chkl_id', 'sequence']);
        });
    }

    public function down(): void {
        Schema::dropIfExists('checklists_itens');
    }
};
