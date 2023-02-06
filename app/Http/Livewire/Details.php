<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\models\Tarea;
use App\models\Afile;
use App\models\Comentario;

class Details extends Component
{
    public $details,$files,$comentarios,$cuanto,$nuevos;
    public function mount($id_tarea)
    {
     $this->details = Tarea::find($id_tarea);
     $this->files = Afile::where('id_tareas', $id_tarea)->get();
     $this->comentarios=Comentario::where('id_tareas', $id_tarea)->get();
     $this->nuevos=Comentario::where('id_tareas', $id_tarea)
     ->where('nuevo', '1')->get()->count();
     $this->cuantos=Comentario::where('id_tareas', $id_tarea)
     ->get()->count();
    //dd($id_tarea,$this->comentarios,$this->cuantos, $this->nuevos);
    }
    public function destroy($id)
    {
        if ($id) {
            $record = Afile::find($id);
            $id_tareas=$record->id_tareas;
            $record->delete();
        }
        session()->flash('message', 'Archivo eliminado satisfactoriamente.');    
        return redirect()->route('tareas.show',$id_tareas);
    }
    public function render()
    {
        return view('livewire.tareas.details',[
            'tareas' => $this->details,
            'afiles' => $this->files,
            'comentarios' => $this->comentarios,
            'cuantos' => $this->cuantos,
            'nuevos'  => $this->nuevos
        ]
    
        );

    }

}
