<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\models\Actividade;
use App\models\Atarea;

class Detalles extends Component
{
    public $detalles;
   
    public function mount($id_actividad)
    {
     $this->detalles = Actividade::find($id_actividad);
    }
    public function render()
    {
        return view('livewire.actividades.detalles',[
            'atareas' => Atarea::where('actividades_id', $this->detalles->id)->get(),
            'actividades' => Actividade::find($this->detalles->id)
        ]);
    }
}
