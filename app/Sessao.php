<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Sessao extends Model {

    protected $table = 'sessoes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'descricao', 'data_inicio'
    ];

    public function leis() {
        return $this->hasMany('App\SessaoLei');
    }

    public function presenca() {
        return $this->hasMany('App\SessaoPresenca');
    }

    public function registrarInicio() {
        $this->data_inicio = date('Y-m-d H:m:i');
    }

}
