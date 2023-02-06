<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Foundation\Auth\RegistersUsers;

class Users extends Component
{
    use WithPagination, RegistersUsers;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $name, $email, $password, $rol_id, $password_confirmation;
    public $updateMode = false;

    public function render()
    {
        $keyWord = '%'.$this->keyWord .'%';
        return view('livewire.users.view', [
            'users' => User::latest()
						->orWhere('name', 'LIKE', $keyWord)
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
		$this->name = null;
		$this->email = null;
        $this->password = null;
        $this->password_confirmation=null;
        $this->rol_id = null; 

    }

    public function store()
    {
        //dd($this->name,$this->email,$this->password,$this->rol_id);
        $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8','confirmed'],
            'rol_id' => ['required','integer', 'min:1']
        ]);

        User::create([ 
			'name' => $this-> name,
			'email' => $this-> email,
            'email_verified_at' => now(),
            'password' => Hash::make($this->password),
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' =>  now()
        ])->assignRole($this->rol_id);
        
        $this->resetInput();
		$this->emit('closeModal');
		session()->flash('message', 'Usuario creado satisfactoriamente.');
    }

    public function edit($id)
    {
        $record = User::findOrFail($id);

        $this->selected_id = $id; 
		$this->name = $record-> name;
		$this->email = $record-> email;
        $this->password = $record->password;
        $this->password_confirmation = $record->password;
        $this->rol_id = $record->role_id;
		
        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8','confirmed'],
            'rol_id' => ['required','integer', 'min:1']
        ]);

        if ($this->selected_id) {
			$record = User::find($this->selected_id);
            $record->update([ 
			'name' => $this-> name,
			'email' => $this-> email,
            'email_verified_at' => now(),
            'password' => Hash::make($this->password),
            'remember_token' => Str::random(10),
            'updated_at' =>  now()
            ]);
            $record = User::find($this->selected_id);            
            $record->roles()->detach();
            $record->permissions()->detach();
            $record->roles()->attach($this->rol_id);
            $record->permissions()->attach($this->rol_id);             
            $this->resetInput();
            $this->updateMode = false;
			session()->flash('message', 'Usuario actualizado correctamente.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            $record = User::find($id);            
            $record->roles()->detach();
            $record->permissions()->detach();
            $record->delete();
        }
    }
}
