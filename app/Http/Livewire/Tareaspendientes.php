<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Tarea;
use Livewire\WithPagination;

class Tareaspendientes extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $descripcion, $actividades_id,$estados_id,$empleados_id;
    public $updateMode = false;
    public function render()
    {
        $keyWord = '%'.$this->keyWord .'%';
        $th=Tarea::where('estados_id',1)->paginate(10);
        return view('livewire.tareas.tareaspendientes', [
            'tpendientes' => Tarea::where('estados_id',1)
                        ->paginate(10),
        ]);   
        
    }
}
