<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTabeSessaoVoto extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('sessao_voto', function(Blueprint $table) {
            $table->increments('id');

            $table->integer('sessao_id');
            $table->foreign('sessao_id')->references('id')
                    ->on('sessoes');

            $table->integer('vereador_id');
            $table->foreign('vereador_id')->references('id')
                    ->on('vereadores');

            $table->integer('lei_id');
            $table->foreign('lei_id')->references('id')
                    ->on('leis');

            $table->boolean('aprovado');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('sessao_voto');
    }

}
