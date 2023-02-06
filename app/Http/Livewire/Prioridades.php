<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Prioridade;

class Prioridades extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $descripcion;
    public $updateMode = false;

    public function render()
    {
		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.prioridades.view', [
            'prioridades' => Prioridade::latest()
						->orWhere('descripcion', 'LIKE', $keyWord)
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
    }

    public function store()
    {
        $this->validate([
		'descripcion' => 'required',
        ]);

        Prioridade::create([ 
			'descripcion' => $this-> descripcion
        ]);
        
        $this->resetInput();
		$this->emit('closeModal');
		session()->flash('message', 'Prioridade Successfully created.');
    }

    public function edit($id)
    {
        $record = Prioridade::findOrFail($id);

        $this->selected_id = $id; 
		$this->descripcion = $record-> descripcion;
		
        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
		'descripcion' => 'required',
        ]);

        if ($this->selected_id) {
			$record = Prioridade::find($this->selected_id);
            $record->update([ 
			'descripcion' => $this-> descripcion
            ]);

            $this->resetInput();
            $this->updateMode = false;
			session()->flash('message', 'Prioridade Successfully updated.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            $record = Prioridade::where('id', $id);
            $record->delete();
        }
    }
}
