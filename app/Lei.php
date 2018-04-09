<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lei extends Model {

    protected $table = 'leis';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'titulo',
        'numero',
        'ano',
        'tipo',
        'vereador_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];

    public function vereador() {
        return $this->belongsTo('App\Vereador', 'vereador_id');
    }

}
