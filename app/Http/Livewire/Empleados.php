<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Empleado;
use App\Models\Puesto;
use App\models\User;
class Empleados extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $nombre, $ap, $am, $curp, $rfc, $puestos_id, $email, $users_id;
    public $updateMode = false;

    public function render()
    {	
		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.empleados.view', [
			'rsu'=> User::all(),
			'rsp'=> Puesto::all(),
            'empleados' => Empleado::latest()
						->orWhere('nombre', 'LIKE', $keyWord)
						->orWhere('ap', 'LIKE', $keyWord)
						->orWhere('am', 'LIKE', $keyWord)
						->orWhere('curp', 'LIKE', $keyWord)
						->orWhere('rfc', 'LIKE', $keyWord)
						->orWhere('puestos_id', 'LIKE', $keyWord)
						->orWhere('email', 'LIKE', $keyWord)
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
		$this->curp = null;
		$this->rfc = null;
		$this->puestos_id = null;
		$this->email = null;
    }

    public function store()
    {
        $this->validate([
		'nombre' => 'required',
		'ap' => 'required',
		'am' => 'required',
		'curp' => 'required',
		'rfc' => 'required',
		'puestos_id' => 'required',
		'email' => 'required',
        ]);

        Empleado::create([ 
			'nombre' => $this-> nombre,
			'ap' => $this-> ap,
			'am' => $this-> am,
			'curp' => $this-> curp,
			'rfc' => $this-> rfc,
			'puestos_id' => $this-> puestos_id,
			'email' => $this-> email
        ]);
        
        $this->resetInput();
		$this->emit('closeModal');
		session()->flash('message', 'Empleado Successfully created.');
    }

    public function edit($id)
    {
        $record = Empleado::findOrFail($id);

        $this->selected_id = $id; 
		$this->nombre = $record-> nombre;
		$this->ap = $record-> ap;
		$this->am = $record-> am;
		$this->curp = $record-> curp;
		$this->rfc = $record-> rfc;
		$this->puestos_id = $record-> puestos_id;
		$this->email = $record-> email;
		
        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
		'nombre' => 'required',
		'ap' => 'required',
		'am' => 'required',
		'curp' => 'required',
		'rfc' => 'required',
		'puestos_id' => 'required',
		'email' => 'required',
        ]);

        if ($this->selected_id) {
			$record = Empleado::find($this->selected_id);
            $record->update([ 
			'nombre' => $this-> nombre,
			'ap' => $this-> ap,
			'am' => $this-> am,
			'curp' => $this-> curp,
			'rfc' => $this-> rfc,
			'puestos_id' => $this-> puestos_id,
			'email' => $this-> email
            ]);

            $this->resetInput();
            $this->updateMode = false;
			session()->flash('message', 'Empleado Successfully updated.');
        }
    }
	public function adduser($id)
    {
        $record = Empleado::findOrFail($id);

        $this->selected_id = $id; 
		$this->nombre = $record-> nombre;
		$this->ap = $record-> ap;
		$this->am = $record-> am;
		$this->curp = $record-> curp;
		$this->rfc = $record-> rfc;
		$this->puestos_id = $record-> puestos_id;
		$this->email = $record-> email;
		
        $this->updateMode = true;
    }
	public function updateadduser()
    {
        $this->validate([
		'nombre' => 'required',
		'ap' => 'required',
		'am' => 'required',
		'curp' => 'required',
		'rfc' => 'required',
		'puestos_id' => 'required',
		'email' => 'required',
		'users_id' => 'required',
        ]);

        if ($this->selected_id) {
			$record = Empleado::find($this->selected_id);
            $record->update([ 
			'nombre' => $this-> nombre,
			'ap' => $this-> ap,
			'am' => $this-> am,
			'curp' => $this-> curp,
			'rfc' => $this-> rfc,
			'puestos_id' => $this-> puestos_id,
			'email' => $this-> email,
			'users_id' => $this-> users_id
            ]);

            $this->resetInput();
            $this->updateMode = false;
			session()->flash('message', 'Usuario asignado satisfactoriamente.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            $record = Empleado::where('id', $id);
            $record->delete();
        }
    }
}
