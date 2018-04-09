<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class ValidateFKRule implements Rule {

    protected $tabela;
    protected $campo;
    protected $value;
    protected $msg;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    function __construct($tabela, $campo, $value, $msg) {
        $this->tabela = $tabela;
        $this->campo = $campo;
        $this->value = $value;
        $this->msg = $msg;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value) {
        $count = DB::table($this->tabela)->where($this->campo, $this->value)->count();
        if ($count > 0) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message() {
        return 'Esse Item não pode ser removido pois está vinculado a um(a) ' . $this->msg;
    }

}
