<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SessaoVoto extends Model {

    protected $table = 'sessao_voto';
    protected $fillable = [
        'sessao_id', 'vereador_id', 'lei_id', 'aprovado',
    ];

    public function vereador() {
        return $this->belongsTo('App\Vereador');
    }

    public function sessao() {
        return $this->belongsTo('App\Sessao');
    }

    public function lei() {
        return $this->belongsTo('App\Lei');
    }

}
