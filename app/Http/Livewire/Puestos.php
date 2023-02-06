<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Puesto;
use App\Models\Area;

class Puestos extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $nomenclatura, $descripcion, $areas_id;
    public $updateMode = false;

    public function render()
    {
		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.puestos.view', [
            'areas'=>Area::all(),
            'puestos' => Puesto::latest()
						->orWhere('nomenclatura', 'LIKE', $keyWord)
						->orWhere('descripcion', 'LIKE', $keyWord)
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
		$this->nomenclatura = null;
		$this->descripcion = null;
		$this->areas_id = null;
    }

    public function store()
    {
        $this->validate([
		'nomenclatura' => 'required',
		'descripcion' => 'required',
		'areas_id' => 'required',
        ]);

        Puesto::create([ 
			'nomenclatura' => $this-> nomenclatura,
			'descripcion' => $this-> descripcion,
			'areas_id' => $this-> areas_id
        ]);
        
        $this->resetInput();
		$this->emit('closeModal');
		session()->flash('message', 'Puesto Successfully created.');
    }

    public function edit($id)
    {
        $record = Puesto::findOrFail($id);

        $this->selected_id = $id; 
		$this->nomenclatura = $record-> nomenclatura;
		$this->descripcion = $record-> descripcion;
		$this->areas_id = $record-> areas_id;
		
        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
		'nomenclatura' => 'required',
		'descripcion' => 'required',
		'areas_id' => 'required',
        ]);

        if ($this->selected_id) {
			$record = Puesto::find($this->selected_id);
            $record->update([ 
			'nomenclatura' => $this-> nomenclatura,
			'descripcion' => $this-> descripcion,
			'areas_id' => $this-> areas_id
            ]);

            $this->resetInput();
            $this->updateMode = false;
			session()->flash('message', 'Puesto Successfully updated.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            $record = Puesto::where('id', $id);
            $record->delete();
        }
    }
}
