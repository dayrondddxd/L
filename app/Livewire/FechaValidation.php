<?php

namespace App\Livewire;

use Livewire\Component;

class FechaValidation extends Component
{
    public $fechaEntrada;
    public $fechaSalida;

    protected $rules = [
        'fechaEntrada' => 'required|date',
        'fechaSalida' => ['required', 'date', function ($attribute, $value, $fail) {
            if ($this->fechaEntrada > $value) {
                $fail('La fecha de salida debe ser posterior a la fecha de entrada.');
            }
        }],
    ];


    public function render()
    {
        return view('livewire.fecha-validation');
    }

    public function updated($field)
    {
        if ($field === 'fechaEntrada') {
            $this->validateOnly(['fechaEntrada']);
        } elseif ($field === 'fechaSalida') {
            $this->validateOnly(['fechaSalida']);
        }
    }
}
