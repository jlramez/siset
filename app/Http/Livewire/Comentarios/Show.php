<?php

namespace App\Http\Livewire\Comentarios;

use Livewire\Component;
use App\Models\Comentario;
use Livewire\WithPagination;

class Show extends Component
{
    use WithPagination;
    public $observaciones;
    public function mount($id_tarea)
    {
     $this->id_tarea = $id_tarea;
     //$this->observaciones = Comentario::where('id_tareas', $this->id_tarea)->paginate(10);
    // dd($this->observaciones,$this->id_tarea);
    }
    public function render()
    {
        $record= Comentario::where('id_tareas',$this->id_tarea )->get();
        foreach($record as $row)
        {
            $row->update
            ([ 
                'nuevo' =>0
            ]);
        }
        return view('livewire.comentarios.view', [
            'comentarios' => Comentario::where('id_tareas',$this->id_tarea )
             ->paginate(10)        
        ]);
      
       
    }
    
    public function destroy($id)
    {
        if ($id) {
            $record = Comentario::where('id', $id);
            $record->delete();
        }
    }
}
