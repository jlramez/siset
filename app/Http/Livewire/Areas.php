<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Area;

class Areas extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $descripcion, $nomenclatura;
    public $updateMode = false;

    public function render()
    {
		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.areas.view', [
            'areas' => Area::latest()
						->orWhere('descripcion', 'LIKE', $keyWord)
						->orWhere('nomenclatura', 'LIKE', $keyWord)
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
		$this->descripcion = null;
		$this->nomenclatura = null;
    }

    public function store()
    {
        $this->validate([
		'descripcion' => 'required',
		'nomenclatura' => 'required',
        ]);

        Area::create([ 
			'descripcion' => $this-> descripcion,
			'nomenclatura' => $this-> nomenclatura
        ]);
        
        $this->resetInput();
		$this->emit('closeModal');
		session()->flash('message', 'Area Successfully created.');
    }

    public function edit($id)
    {
        $record = Area::findOrFail($id);

        $this->selected_id = $id; 
		$this->descripcion = $record-> descripcion;
		$this->nomenclatura = $record-> nomenclatura;
		
        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
		'descripcion' => 'required',
		'nomenclatura' => 'required',
        ]);

        if ($this->selected_id) {
			$record = Area::find($this->selected_id);
            $record->update([ 
			'descripcion' => $this-> descripcion,
			'nomenclatura' => $this-> nomenclatura
            ]);

            $this->resetInput();
            $this->updateMode = false;
			session()->flash('message', 'Area Successfully updated.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            $record = Area::where('id', $id);
            $record->delete();
        }
    }
}
