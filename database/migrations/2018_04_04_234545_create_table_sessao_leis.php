<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableSessaoLeis extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('sessao_leis', function(Blueprint $table) {
            $table->increments('id');

            $table->integer('sessao_id')->nullable();
            $table->foreign('sessao_id')->references('id')
                    ->on('sessoes');

            $table->integer('lei_id')->nullable();
            $table->foreign('lei_id')->references('id')
                    ->on('leis');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('sessao_leis');
    }

}
