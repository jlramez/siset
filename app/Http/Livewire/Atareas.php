<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Atarea;
use App\Models\Empleado;
use App\Models\Actividade;
use App\Models\Tarea;
use App\Models\Estado;
use App\Models\Area;
use App\Models\Puesto;
use Spatie\Permission\Models\Role;

class Atareas extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $fecha_entrega,$descripcion, $selected_id, $keyWord, $actividades_id, $tareas_id, $empleados_id,$estados_id;
    public $empleado;
    public $updateMode = false;

    public function render()
    {
		$id=auth()->user()->id;
        //dd($id);
        
        $empleado=Empleado::where('users_id',$id)->first();
        
        /*$atareas=Atarea::where('empleados_id',$empleado->id)->get();
          dd($atareas);*/
       if ($empleado)
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
       $actividades_full=Actividade::Latest()->get();
       $empleados=Empleado::all();

     break;
         
    case('secretaria'): //secretaria

       $tareas=Tarea::Latest()->paginate(10);//todas las tareas
       $actividades=Actividade::Latest()->paginate(10);//todas las actividades
       $actividades_full=Actividade::Latest()->get();
       $empleados=Empleado::all();//todos los empleados

        break;
         
    case('sub_secretaria'): //sub_secretaria

       $tareas=Tarea::join('actividades','actividades_id', '=', 'actividades.id')->join('areas','areas.id', '=','actividades.areas_id')->where('areas.id','=',$area_id)-> select('tareas.*')
             ->paginate(10);
             $actividades=Actividade::where('areas_id',$area_id)->Latest()->paginate(10);
             $actividades_full=Actividade::where('areas_id',$area_id)->Latest()->get();

             $empleados=Empleado::join('puestos','puestos_id','=','puestos.id')->where('puestos.superior','=',$area_id)->select('empleados.*')->paginate(10); 
        break;
        default:
            
            $tareas=Tarea::join('actividades','actividades_id', '=', 'actividades.id')->select('tareas.*')->where('actividades.areas_id',$area_id)
             ->paginate(10);         
             $actividades=Actividade::where('areas_id',$area_id)->Latest()->paginate(10);
             $actividades_full=Actividade::where('areas_id',$area_id)->Latest()->get();
             $empleados=Empleado::join('puestos','puestos_id', '=', 'puestos.id')->select('empleados.*')->where('puestos.areas_id',$area_id)->paginate(10);
}



        
            $keyWord = '%'.$this->keyWord .'%';
            return view('livewire.atareas.view', [
                'emp' => Empleado::all(),
                'actividades' => $actividades,
                'actividades_full' => $actividades_full,
                'estados' => Estado::all(),
                'tarea' => Tarea::all(),
                'empleado' => $empleado,
                'atareas' => Atarea::where('empleados_id',$empleado->id)
                            ->paginate(10),
            ]);

         
        }
        else
        {
            $this->resetInput();
            $this->emit('closeModal');
            session()->flash('message', 'Empleado innexistente.');           
            return view('livewire.tareas.index');
            
        }
    }
	
    public function cancel()
    {
        $this->resetInput();
        $this->updateMode = false;
    }
	
    private function resetInput()
    {		
		$this->actividades_id = null;
		$this->tareas_id = null;
		$this->empleados_id = null;
    }

    public function store()
    {
        $this->validate([
		'actividades_id' => 'required',
        'fecha_entrega' => 'required',
        'descripcion' => 'required'
		/*'tareas_id' => 'required',
		'empleados_id' => 'required',*/
        ]);

        $estados_id=1;
        $fechaentrega= Carbon::createFromFormat('Y-m-d', $this->fecha_entrega)->format('Y-m-d');
        $user_id=auth()->user()->id;
        $empleado_id=Empleado::where('users_id',$user_id)->first();
        //dd($user_id, $empleado_id);
        Tarea::create([ 
			'descripcion' => $this-> descripcion,
			'actividades_id' => $this-> actividades_id,
            'estados_id' => $estados_id,
            'fecha_entrega' => $fecha_entrega
        ]);
       $tarea_id=Tarea::latest()->first();
       //dd($tarea_id->id);
        Atarea::create([ 
			'actividades_id' => $this-> actividades_id,
			'tareas_id' => $tarea_id->id,
			'empleados_id' => $empleado_id->id
        ]);
        
        $this->resetInput();
		$this->emit('closeModal');
		session()->flash('message', 'Atarea Successfully created.');
    }

    public function edit($id)
    {
        $record = Atarea::findOrFail($id);

        $this->selected_id = $id; 
		$this->actividades_id = $record-> actividades_id;
		$this->tareas_id = $record-> tareas_id;
		$this->empleados_id = $record-> empleados_id;
		
        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
		'actividades_id' => 'required',
		'tareas_id' => 'required',
		'empleados_id' => 'required',
        ]);

        if ($this->selected_id) {
			$record = Atarea::find($this->selected_id);
            $record->update([ 
			'actividades_id' => $this-> actividades_id,
			'tareas_id' => $this-> tareas_id,
			'empleados_id' => $this-> empleados_id
            ]);

            $this->resetInput();
            $this->updateMode = false;
			session()->flash('message', 'Atarea Successfully updated.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            $record = Atarea::where('id', $id);
            $record->delete();
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
        //dd($id);//id_atareas
        $record = Atarea::find($id);
        $contador=Tarea::where('id', $record->tareas_id)->count();
        $nombre=Actividade::where('id', $record->tareas->actividades_id)->get();
        foreach ($nombre as $row)
        {
            $nom_act=$row->nombre;
        }
        //if ($contador!=0){       
        $this->selected_id = $record->tareas->id; 
        $this->descripcion = $record->tareas->descripcion;
        $this->updateMode = true;
       

       // }
    }
    public function storestado()
    {
        $this->validate([
            //'descripcion' => 'required',
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
                //dd($this->selected_id);
            if ($this->selected_id) {
                $record = Tarea::find($this->selected_id);
                $record->update([ 
                'estados_id' => $this-> estados_id,
                'ended_at' => $finish_date
                ]);
                $act_id=$record->actividades_id;
                $calculo=new Atareas();
                $calculo=$this->calculate($act_id);  
                $this->resetInput();
                $this->emit('closeModal');
                $this->updateMode = false;
                session()->flash('message', 'Estado de la actividad actualizada correctamente.');
            }
        }
}
