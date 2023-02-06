<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\models\Comentario;

class Comentarios extends Component
{
    public $tareas, $id_tareas, $contenido, $id_users, $nuevo;
    public function mount($id_tarea)
    {
     $this->id_tarea = $id_tarea;
     //dd($this->id_tarea);
    }
    protected $rules=
    [
        'contenido'=>
         [
            'required',
         ]
    ];
    private function resetInput()
    {		
		$this->contenido = null;

    }
    public function save()
    {
        //dd($this->id_tarea);
        $this->validate();
        Comentario::create([ 
			'id_tareas' => $this-> id_tarea,
			'id_users' => auth()->user()->id,
			'contenido' => $this-> contenido,
			'nuevo' => "1",
        ]);
        
        $this->resetInput();
        session()->flash('message', 'Comentario creado satisfactoriamente.');    
        return redirect()->route('tareas.show',$this->id_tarea);

    }
    public function destroy($id)
    {
        if ($id) {
            $record = Afile::find($id);
            $id_tareas=$record->id_tareas;
            $record->delete();
        }
        session()->flash('message', 'Comentario eliminado satisfactoriamente.');    
        return redirect()->route('tareas.show',$id_tareas);
    }
    public function render()
    {
        return view('livewire.comentarios.create');
    }
}
