<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableSessaoPresenca extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('sessao_presenca', function(Blueprint $table) {
            $table->increments('id');

            $table->integer('sessao_id');
            $table->foreign('sessao_id')->references('id')
                    ->on('sessoes');

            $table->integer('vereador_id');
            $table->foreign('vereador_id')->references('id')
                    ->on('vereadores');

            $table->string('motivo')->nullable();
            $table->boolean('presente');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('sessao_presenca');
    }

}
