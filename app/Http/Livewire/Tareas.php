<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Tarea;
use App\Models\Actividade;
use App\Models\Empleado;
use App\Models\Atarea;
use App\Models\Estado;
use App\Models\Area;
use App\Models\Puesto;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasPermissions;
use Spatie\Permission\Traits\HasRoles;
use Carbon\Carbon;

class Tareas extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $descripcion, $actividades_id,$estados_id,$empleados_id, $fecha_entrega;
    public $updateMode = false;

    public function render()
    {
	            $id_user=auth()->user()->id;
                $empleado=Empleado::where('users_id', $id_user)->first();
                $area_id=$empleado->puesto->area->id;
                $area=Area::find($area_id);
                $nivel_jefe_superior=Puesto::where('areas_id',$area_id)->max('niveles_id');

        $usuariosConRol = Role::whereHas("permissions", function($q){ $q->where("name", "registros.index"); })->get();
        $id_rol_usuario=auth()->user()->roles()->first()->id; //id users role
        $rol=role::where('id',$id_rol_usuario)->first();//recorset role
        $keyWord = '%'.$this->keyWord .'%';
        switch($rol->name) 
        {
             case('admin'): //administrador
               $tareas=Tarea::Latest()->paginate(10);
               $actividades=Actividade::Latest()->paginate(10);
               $empleados=Empleado::all();
               $actividades_full=Actividade::all();
 
             break;
                 
            case('secretaria'): //secretaria
 
               $tareas=Tarea::Latest()->paginate(10);//todas las tareas
               $actividades=Actividade::Latest()->paginate(10);//todas las actividades
               $empleados=Empleado::all();//todos los empleados
               $actividades_full=Actividade::all();
               
 
                break;
                 
            case('sub_secretaria'): //sub_secretaria
 
               $tareas=Tarea::join('actividades','actividades_id', '=', 'actividades.id')->join('areas','areas.id', '=','actividades.areas_id')->where('areas.id','=',$area_id)-> select('tareas.*')
                     ->paginate(10);
                     $actividades=Actividade::where('areas_id',$area_id)->paginate(10);
                     $actividades_full= Actividade::where('areas_id',$area_id)->get();

                     $empleados=Empleado::join('puestos','puestos_id','=','puestos.id')->where('puestos.superior','=',$area_id)->select('empleados.*')->paginate(10); 
                break;
                default:
                    
                    $tareas=Tarea::join('actividades','actividades_id', '=', 'actividades.id')->select('tareas.*')->where('actividades.areas_id',$area_id)
                     ->paginate(10);         
                     $actividades=Actividade::where('areas_id',$area_id)->paginate(10);
                     $actividades_full= Actividade::where('areas_id',$area_id)->get();
                     $empleados=Empleado::join('puestos','puestos_id', '=', 'puestos.id')->select('empleados.*')->where('puestos.areas_id',$area_id)->paginate(10);
        }


                $keyWord = '%'.$this->keyWord .'%';
                return view('livewire.tareas.view', [
                    'estados' => Estado::all(),
                    'atareas' => Atarea::all(),
                    'empleados' => $empleados,
                    'actividades' => $actividades,
                    'tareas' => $tareas,
                    'actividades_full'=> $actividades_full,
                    /*Tarea::join('actividades','actividades_id', '=', 'actividades.id')->select('tareas.*')->where('actividades.areas_id',$area_id)
                     /*->orWhere('descripcion', 'LIKE', $keyWord)
                     ->orWhere('actividades_id', 'LIKE', $keyWord)
                     ->orWhere('estados_id', 'LIKE', $keyWord)
                     ->paginate(10),*/
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
		$this->actividades_id = null;
    }

    public function store()
    {
        $this->validate([
		'descripcion' => 'required',
		'actividades_id' => 'required',
        'fecha_entrega' => 'required',
    ]);
         $estados_id=1;
        $fechaentrega= Carbon::createFromFormat('Y-m-d', $this->fecha_entrega)->format('Y-m-d');
        Tarea::create([ 
			'descripcion' => $this-> descripcion,
			'actividades_id' => $this-> actividades_id,
            'estados_id' => $estados_id,
             'fecha_entrega' => $fechaentrega
        ]);
        
        $this->resetInput();
        $this->emit('closeModal');
		session()->flash('message', 'Tarea Successfully created.');
    }

    public function edit($id)
    {
      
        $record = Tarea::findOrFail($id);


        $this->selected_id = $id; 
		$this->descripcion = $record-> descripcion;
		$this->actividades_id = $record-> actividades_id;
         $this->fecha_entrega=$record-> fecha_entrega;
		
        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
		'descripcion' => 'required',
		'actividades_id' => 'required',
        'fecha_entrega' => 'required'
        ]);
        $fechaentrega= Carbon::createFromFormat('Y-m-d', $this->fecha_entrega)->format('Y-m-d');
        if ($this->selected_id) 
        {
			
            $record = Tarea::find($this->selected_id);
            $record->update([ 
			'descripcion' => $this-> descripcion,
			'actividades_id' => $this-> actividades_id,
            'fecha_entrega' => $fechaentrega
            ]);

            $this->resetInput();
            $this->updateMode = false;
			session()->flash('message', 'Tarea Successfully updated.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            $record = Tarea::where('id', $id);
            $record->delete();
        }
    }
    public function addemp($id)
    {
        $record = Tarea::find($id);
        $contador=Tarea::where('id', $id)->count();
        $nombre=Actividade::where('id', $record->actividades_id)->get();
        foreach ($nombre as $row)
        {
            $nom_act=$row->nombre;
        }
        //if ($contador!=0){       
        $this->selected_id = $id; 
		$this->descripcion = $record-> descripcion;
		$this->actividades_id = $nom_act;
        $this->updateMode = true;
       

       // }
    }
    public function storemp()
    {
      

        if ($this->selected_id)
        {
            $record = Tarea::find($this->selected_id);
            $actividades_id=$record->actividades_id;
        }
            //dd($this-> empleados_id);

        Atarea::create([ 
			'actividades_id' => $actividades_id,
			'tareas_id' => $this-> selected_id,
			'empleados_id' => $this-> empleados_id
        ]);
        
        $this->resetInput();
		$this->emit('closeModal');
		session()->flash('message', 'Empleado Successfully asignado.');
    } 
    public function select_emp($id)
    {
           $record = Atarea::find($id);
           foreach ($record as $row)
           {
            $emp[]=$row->nombre.$row->ap.$row->am;
           }
           return($emp);
    }
    public function checked($id)
    {
    
            if ($id) 
            {
                $record = Tarea::find($id);
                $estados_id=$record->estados_id; 
                $act_id=$record->actividades_id;       
                if($estados_id==2)
                {
                  $estados_id=1;
                  $record->update([ 
                    'estados_id' => $estados_id,
                    'ended_at' => null
                    ]);    
                    $calculo=new Tareas();
                    $calculo=$this->calculate($act_id);
                    $this->resetInput();
                    $this->updateMode = false;
                    session()->flash('message', 'Tarea NO realizada.');
                    $calculo=new Tareas();
                    $calculo=$this->calculate($act_id);
                }
                elseif($estados_id==1)
                {
                  $estados_id=2;
                  $record->update([ 
                    'estados_id' => $estados_id,
                    'ended_at' => now()
                    ]);
                    $calculo=new Tareas();
                    $calculo=$this->calculate($act_id);    
                    $this->resetInput();
                    $this->updateMode = false;
                    session()->flash('message', 'Tarea realizada satisfactoriamente.');
                    
                }
            }
    }
    
    public function calculate($act_id)
    {
       
        $record = Actividade::findOrFail($act_id);
        $act_total= Tarea::where('actividades_id', $act_id)->count();
        $act_realizadas=Tarea::where('estados_id',2)
        ->where('actividades_id', $act_id)->count();  
        if($act_total==0) 
        {
         session()->flash('message', 'Porcentaje de avance NO calculado.');
         exit;
        }    
         $por_ok=($act_realizadas/$act_total)*100;
        // dd($act_total,$act_realizadas,$por_ok);
            if ($act_id) 
            {
              
                $record = Actividade::find($act_id);
               // dd($record->nombre, $por_ok);
                $record->update([ 
                'nombre' => $record-> nombre,
                'descripción' => $record-> descripción,
                'id_prioridad' => $record-> id_prioridad,
                'areas_id' => $record-> areas_id,
                'avance' => $por_ok
                ]);
               /* $this->resetInput();
                $this->updateMode = false;
                session()->flash('message', 'Porcentaje de avance calculado.');*/
            }
    }
    public function addestado($id)
    {
        $record = Tarea::find($id);
        $contador=Tarea::where('id', $id)->count();
        $nombre=Actividade::where('id', $record->actividades_id)->get();
        foreach ($nombre as $row)
        {
            $nom_act=$row->nombre;
        }
        //if ($contador!=0){       
        $this->selected_id = $id; 
		$this->descripcion = $record-> descripcion;
        $this->updateMode = true;
       

       // }
    }
    public function storestado()
    {
        $this->validate([
            'descripcion' => 'required',
            'estados_id' => 'required',
            ]);
    
            if ($this->estados_id==1)
                {
                    $finish_date=null;
                }
                if ($this->estados_id==2)
                {
                    $finish_date=now();
                }
                if ($this->estados_id==3)
                {
                    $finish_date=null;
                }
            if ($this->selected_id) {
                $record = Tarea::find($this->selected_id);
                $record->update([ 
                'estados_id' => $this-> estados_id,
                'ended_at' => $finish_date
                ]);
                $act_id=$record->actividades_id;
                $calculo=new Tareas();
                $calculo=$this->calculate($act_id);  
                $this->resetInput();
                $this->emit('closeModal');
                $this->updateMode = false;
                session()->flash('message', 'Estado de la actividad actualizada correctamente.');
            }
        }
        
    public function detalles($id)
    {
        $record = Tarea::findOrFail($id);

        $this->selected_id = $id; 
		$this->descripcion = $record-> descripcion;
		$this->actividades_id = $record-> actividades_id;
        $actividad= Actividade::finddirst($record->actividades_id);
        dd($actividad);
		
        $this->updateMode = true;
    }
    
}