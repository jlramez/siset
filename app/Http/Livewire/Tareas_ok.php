<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Tarea;
use App\Models\Actividade;
use App\Models\Empleado;
use App\Models\Atarea;
use App\Models\Puesto;
use App\Models\Estado;
use App\Models\Area;
use Carbon\Carbon;
use DB;

class Tareas extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $descripcion, $actividades_id,$estados_id,$empleados_id,$fecha_entrega;
    public $area_id;
    public $updateMode = false;

    public function render()
    {
	
                $id_user=auth()->user()->id;
                $empleado=Empleado::where('users_id', $id_user)->first();
                /*$puesto_id=$empleado->puestos_id;
                $puesto=Puesto::find($puesto_id)->first();
                $area_id=$puesto->areas_id;
                $tareas= DB::select('SELECT * FROM tareas,actividades WHERE tareas.actividades_id=actividades.id and actividades.areas_id='.$area_id);*/
                $area_id=$empleado->puesto->area->id;
                //dd($area_id);
                               
                $keyWord = '%'.$this->keyWord .'%';
                return view('livewire.tareas.view', [
                    'estados' => Estado::all(),
                    'atareas' => Atarea::all(),
                    'empleados' => Empleado::all(),
                    'actividades' => Actividade::all(),
                    'tareas' => Tarea::join('actividades','actividades_id', '=', 'actividades.id')->select('*')->where('actividades.areas_id',$area_id)
                     /*->orWhere('descripcion', 'LIKE', $keyWord)
                     ->orWhere('actividades_id', 'LIKE', $keyWord)
                     ->orWhere('estados_id', 'LIKE', $keyWord)*/
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
          //dd($this->fecha_entrega);
         $fechaentrega= Carbon::createFromFormat('Y-m-d', $this->fecha_entrega)->format('Y-m-d');
        // $evento->start=Carbon::createFromFormat('Y-m-d H:i:s', $evento->start)->format('Y-m-d'); 
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

        if ($this->selected_id) {
			$record = Tarea::find($this->selected_id);
            $record->update([ 
			'descripcion' => $this-> descripcion,
			'actividades_id' => $this-> actividades_id,
            'fecha_entrega' => Carbon::createFromFormat('Y-m-d', $this->fecha_entrega)->format('Y-m-d')
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
                dd('hola', $this-> estados_id,$this->selected_id);
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