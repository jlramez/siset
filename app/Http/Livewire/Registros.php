<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Registro;
use App\Models\Servicio;

class Registros extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $nombre, $ap, $am, $edad, $primera_vez, $servicios_id, $centros_id, $Observaciones;
    public $updateMode = false;

    public function render()
    {    
		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.registros.view', [
			'rss' => Servicio::all(),
            'registros' => Registro::latest()
						->orWhere('nombre', 'LIKE', $keyWord)
						->orWhere('ap', 'LIKE', $keyWord)
						->orWhere('am', 'LIKE', $keyWord)
						->orWhere('edad', 'LIKE', $keyWord)
						->orWhere('primera_vez', 'LIKE', $keyWord)
						->orWhere('servicios_id', 'LIKE', $keyWord)
						->orWhere('Observaciones', 'LIKE', $keyWord)
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
		$this->ap = null;
		$this->am = null;
		$this->edad = null;
		$this->primera_vez = null;
		$this->servicios_id = null;
		$this->centros_id= null;
		$this->Observaciones = null;
    }

    public function store()
    {
        $this->validate([
		'nombre' => 'required',
		'ap' => 'required',
		'am' => 'required',
		'edad' => 'required',
		'primera_vez' => 'required',
		'servicios_id' => 'required',
		'centros_id' => 'required',
		'Observaciones' => 'required',
        ]);

        Registro::create([ 
			'nombre' => $this-> nombre,
			'ap' => $this-> ap,
			'am' => $this-> am,
			'edad' => $this-> edad,
			'primera_vez' => $this-> primera_vez,
			'servicios_id' => $this-> servicios_id,
			'centros_id' => $this-> centros_id,
			'Observaciones' => $this-> Observaciones
        ]);
        
        $this->resetInput();
		$this->emit('closeModal');
		session()->flash('message', 'Registro Successfully created.');
    }

    public function edit($id)
    {
        $record = Registro::findOrFail($id);

        $this->selected_id = $id; 
		$this->nombre = $record-> nombre;
		$this->ap = $record-> ap;
		$this->am = $record-> am;
		$this->edad = $record-> edad;
		$this->primera_vez = $record-> primera_vez;
		$this->servicios_id = $record-> servicios_id;
		$this->Observaciones = $record-> Observaciones;
		
        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
		'nombre' => 'required',
		'ap' => 'required',
		'am' => 'required',
		'edad' => 'required',
		'primera_vez' => 'required',
		'servicios_id' => 'required',
		'Observaciones' => 'required',
        ]);

        if ($this->selected_id) {
			$record = Registro::find($this->selected_id);
            $record->update([ 
			'nombre' => $this-> nombre,
			'ap' => $this-> ap,
			'am' => $this-> am,
			'edad' => $this-> edad,
			'primera_vez' => $this-> primera_vez,
			'servicios_id' => $this-> servicios_id,
			'Observaciones' => $this-> Observaciones
            ]);

            $this->resetInput();
            $this->updateMode = false;
			session()->flash('message', 'Registro Successfully updated.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            $record = Registro::where('id', $id);
            $record->delete();
        }
    }
}
