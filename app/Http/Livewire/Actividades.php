<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Actividade;
use App\Models\Tarea;
use App\Models\Prioridade;
use App\Models\Area;


class Actividades extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $nombre, $descripción, $id_prioridad, $areas_id,$avance;
    public $updateMode = false;

    public function render()
    {
		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.actividades.view', [
            'rsa' => Area::all(),
            'rsp' => Prioridade::all(),
            'actividades' => Actividade::latest()
						->orWhere('nombre', 'LIKE', $keyWord)
						->orWhere('descripción', 'LIKE', $keyWord)
						->orWhere('id_prioridad', 'LIKE', $keyWord)
						->orWhere('areas_id', 'LIKE', $keyWord)
						->paginate(10),
        ]);
    }
	
    public function cancel()
    {
        $this->resetInput();
        $this->updateMode = false;
    }
	
    private function resetInput()
    {		
		$this->nombre = null;
		$this->descripción = null;
		$this->id_prioridad = null;
		$this->areas_id = null;
    }

    public function store()
    {
        $this->validate([
		'nombre' => 'required',
		'descripción' => 'required',
		'id_prioridad' => 'required',
		'areas_id' => 'required',
        ]);

        Actividade::create([ 
			'nombre' => $this-> nombre,
			'descripción' => $this-> descripción,
			'id_prioridad' => $this-> id_prioridad,
			'areas_id' => $this-> areas_id,
            'avance' => '0'
        ]);
        
        $this->resetInput();
		$this->emit('closeModal');
		session()->flash('message', 'Actividade Successfully created.');
    }

    public function edit($id)
    {
        $record = Actividade::findOrFail($id);

        $this->selected_id = $id; 
		$this->nombre = $record-> nombre;
		$this->descripción = $record-> descripción;
		$this->id_prioridad = $record-> id_prioridad;
		$this->areas_id = $record-> areas_id;
		
        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
		'nombre' => 'required',
		'descripción' => 'required',
		'id_prioridad' => 'required',
		'areas_id' => 'required',
        ]);

        if ($this->selected_id) {
			$record = Actividade::find($this->selected_id);
            $record->update([ 
			'nombre' => $this-> nombre,
			'descripción' => $this-> descripción,
			'id_prioridad' => $this-> id_prioridad,
			'areas_id' => $this-> areas_id
            ]);

            $this->resetInput();
            $this->updateMode = false;
			session()->flash('message', 'Actividade Successfully updated.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            $record = Actividade::where('id', $id);
            $record->delete();
        }
    }
    public function calculate($id)
    {
       
        $record = Actividade::findOrFail($id);
        $act_total= Tarea::where('actividades_id', $id)->count();
        $act_realizadas=Tarea::where('estados_id',2)
        ->where('actividades_id', $id)->count();  
        if($act_total==0) 
        {
         session()->flash('message', 'Porcentaje de avance NO calculado.');
         exit;
        }    
         $por_ok=($act_realizadas/$act_total)*100;
        // dd($act_total,$act_realizadas,$por_ok);
            if ($id) {
              
                $record = Actividade::find($id);
                //dd($record->nombre, $por_ok);
                $record->update([ 
                'nombre' => $record-> nombre,
                'descripción' => $record-> descripción,
                'id_prioridad' => $record-> id_prioridad,
                'areas_id' => $record-> areas_id,
                'avance' => $por_ok
                ]);
                $this->resetInput();
                $this->updateMode = false;
                session()->flash('message', 'Porcentaje de avance calculado.');
            }
    }
    public function show($id)
    {
        //$id_actividad=Actividade::find($id);

        return view('livewire.actividades.show');
    }
}
