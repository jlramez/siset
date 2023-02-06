<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Atarea;
use App\Models\Empleado;
use App\Models\Actividade;
use App\Models\Tarea;

class Atareas extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $actividades_id, $tareas_id, $empleados_id;
    public $updateMode = false;

    public function render()
    {
		$id=auth()->user()->id;
        //dd($id);
        
        $empleado=Empleado::where('users_id',$id)->first();
        
        /*$atareas=Atarea::where('empleados_id',$empleado->id)->get();
          dd($atareas);*/
       if ($empleado)
       {
            $keyWord = '%'.$this->keyWord .'%';
            return view('livewire.atareas.view', [
                'emp' => Empleado::all(),
                'actividad' => Actividade::all(),
                'tarea' => Tarea::all(),
                'empleado' => $empleado,
                'atareas' => Atarea::where('empleados_id',$empleado->id)
                            ->paginate(10),
            ]);

         
        }
        else
        {
            $this->resetInput();
            $this->emit('closeModal');
            session()->flash('message', 'Empleado innexistente.');           
            return view('livewire.tareas.index');
            
        }
    }
	
    public function cancel()
    {
        $this->resetInput();
        $this->updateMode = false;
    }
	
    private function resetInput()
    {		
		$this->actividades_id = null;
		$this->tareas_id = null;
		$this->empleados_id = null;
    }

    public function store()
    {
        $this->validate([
		'actividades_id' => 'required',
		'tareas_id' => 'required',
		'empleados_id' => 'required',
        ]);

        Atarea::create([ 
			'actividades_id' => $this-> actividades_id,
			'tareas_id' => $this-> tareas_id,
			'empleados_id' => $this-> empleados_id
        ]);
        
        $this->resetInput();
		$this->emit('closeModal');
		session()->flash('message', 'Atarea Successfully created.');
    }

    public function edit($id)
    {
        $record = Atarea::findOrFail($id);

        $this->selected_id = $id; 
		$this->actividades_id = $record-> actividades_id;
		$this->tareas_id = $record-> tareas_id;
		$this->empleados_id = $record-> empleados_id;
		
        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
		'actividades_id' => 'required',
		'tareas_id' => 'required',
		'empleados_id' => 'required',
        ]);

        if ($this->selected_id) {
			$record = Atarea::find($this->selected_id);
            $record->update([ 
			'actividades_id' => $this-> actividades_id,
			'tareas_id' => $this-> tareas_id,
			'empleados_id' => $this-> empleados_id
            ]);

            $this->resetInput();
            $this->updateMode = false;
			session()->flash('message', 'Atarea Successfully updated.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            $record = Atarea::where('id', $id);
            $record->delete();
        }
    }
}
