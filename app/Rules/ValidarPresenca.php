<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\SessaoPresenca;

class ValidarPresenca implements Rule {

    public $sessao, $vereador, $motivo;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($sessao, $vereador) {
        $this->sessao = $sessao;
        $this->vereador = $vereador;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value) {
        $presenca = SessaoPresenca::where('sessao_id', $this->sessao)
                        ->where('vereador_id', $this->vereador)->first();
        if ($presenca instanceof SessaoPresenca) {
            if ($presenca->presente) {
                return true;
            } else {
                $this->motivo = $presenca->motivo;
            }
        } else {
            $this->motivo = null;
            return false;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message() {
        if ($this->motivo) {
            return 'O vereador não pode votar, pois está ausente.\nMotivo:' . $this->motivo;
        }
        return 'Este vereador não pode votar, pois ainda não registrou presença.';
    }

}
