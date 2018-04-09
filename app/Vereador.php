<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vereador extends Model {

    protected $table = 'vereadores';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nome', 'partido'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];

}
