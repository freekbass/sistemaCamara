<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SessaoPresenca extends Model {
    protected $table = 'sessao_presenca';
 
    protected $fillable = [
        'sessao_id', 'vereador_id', 'presente', 'motivo',
    ];

    public function vereador() {
        return $this->belongsTo('App\Vereador');
    }

    public function sessao() {
        return $this->belongsTo('App\Sessao');
    }

}
