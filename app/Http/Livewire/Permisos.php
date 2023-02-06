<?php

namespace App\Http\Livewire;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class Permisos extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $name, $guard_name;
    public $updateMode = false;

    public function render()
    {
        $keyWord = '%'.$this->keyWord .'%';
        return view('livewire.permisos.view', [
            'rsp' => Permission::all(),
            'permisos' => Permission::latest()
						->orWhere('name', 'LIKE', $keyWord)
						->orWhere('guard_name', 'LIKE', $keyWord)
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
		$this->name = null;
		$this->guard_name = null;
    }

    public function store()
    {
        $this->validate([
		'name' => 'required',
		//'guard_name' => 'required',
        ]);
        /*Role::create([ 
			'name' => $this-> name,
			'guard_name' => $this-> guard_name
        ]);*/
       Permission::create(['name'=>$this-> name,'guard_name'=>"web"]);
        
        $this->resetInput();
		$this->emit('closeModal');
		session()->flash('message', 'Permiso creado satisfactoriamente.');
    }

    public function edit($id)
    {
        $record = Role::findOrFail($id);

        $this->selected_id = $id; 
		$this->name = $record-> name;
		$this->guard_name = $record-> guard_name;
		
        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
		'name' => 'required',
		'guard_name' => 'required',
        ]);

        if ($this->selected_id) {
			$record = Role::find($this->selected_id);
            $record->update([ 
			'name' => $this-> name,
			'guard_name' => $this-> guard_name
            ]);

            $this->resetInput();
            $this->updateMode = false;
			session()->flash('message', 'Role Successfully updated.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            $record = Role::where('id', $id);
            $record->delete();
        }
    } 
    public function addpermissions($id)
    {
        
        $record = Role::findOrFail($id);
        $this->selected_id = $id; 
		$this->name = $record-> name;

    }
    public function storepermissions()
    {
        
        $this->validate([
            'permisos' => 'required',
            'name' => 'required',
            ]);
            /*Role::create([ 
                'name' => $this-> name,
                'guard_name' => $this-> guard_name
            ]);*/
            foreach ($this->permisos as $permiso_id=>$valor)
    		{
                $nombre_permiso=$valor;
                $nombre_rol=$this->name;
                //dd($valor,$nombre_rol);
                $permission = Permission::findByName($nombre_permiso);
                //dd($permisions);
                $permission->assignRole([$nombre_rol]); 
            }
            $this->resetInput();
            $this->emit('closeModal');
            session()->flash('message', 'Permisos asignados correctamente.');

    }
}

