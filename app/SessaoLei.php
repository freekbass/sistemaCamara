<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SessaoLei extends Model {
    
    protected $fillable = [
        'sessao_id', 'lei_id',
    ];

    public function lei() {
        return $this->belongsTo('App\Lei');
    }

    public function sessao() {
        return $this->belongsTo('App\Sessao');
    }

}
