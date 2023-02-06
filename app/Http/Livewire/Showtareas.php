<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\models\Tarea;

class Showtareas extends Component
{
    public $idact;
   
    public function mount($id_actividad)
    {
     $this->idact=$id_actividad;
    }
    public function render()
    {
        return view('livewire.actividades.showtareas',[
            'tareas' => Tarea::where('actividades_id', $this->idact)->paginate(10)
        ]);
    }
}
