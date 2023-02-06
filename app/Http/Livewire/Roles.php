<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasPermissions;
use Spatie\Permission\Traits\HasRoles;

use App\models\User;

class Roles extends Component
{
    

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $name, $guard_name,$permisos=[];
    public $updateMode = false;

    public function render()
    {
        $rol=Role::latest();
        foreach ($rol as $r)
        {
		//dd($r->permissions);
       
        }
       // dd($permissions);
       $keyWord = '%'.$this->keyWord .'%';
        return view('livewire.roles.view', [
            'rsp' => Permission::all(),
            'roles' => Role::latest()
            ->orWhere('name', 'LIKE', $keyWord)
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
       Role::create(['name'=>$this-> name,'guard_name'=>"web"]);
        
        $this->resetInput();
		$this->emit('closeModal');
		session()->flash('message', 'Role Successfully created.');
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
                //$role=Role::findbyName($nombre_rol);
                //dd($permission->id);
                //$role->permissions()->attach($permission->id);
                //$role->givePermissionTo($permission);
            }
            $this->resetInput();
            $this->emit('closeModal');
            session()->flash('message', 'Permisos asignados correctamente.');
    }
    public function editpermissions($id)
            {
                
                $record = Role::findOrFail($id);
                $this->selected_id = $id; 
                $this->name = $record-> name;
        
            }
            public function updatepermissions()
            {
                $this->validate([
                'name' => 'required',
                //'guard_name' => 'required',
                ]);
                if ($this->selected_id) 
            {
                foreach ($this->permisos as $permiso_id=>$valor)
                {
                    $nombre_permiso=$valor;
                    $nombre_rol=$this->name;
                    $permission = Permission::findByName($nombre_permiso);
                    $role=Role::findbyName($nombre_rol);
                    $role->revokePermissionTo($permission->id);
                }
            
                //$this->resetInput();
                $this->emit('closeModal');
                $this->updateMode = false;
                session()->flash('message', 'Permiso elimindado satisfactoriamente');
            
            }
        }
    
}
