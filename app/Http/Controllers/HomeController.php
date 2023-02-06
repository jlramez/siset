<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tarea;
use App\Models\Empleado;
use App\Models\Atarea;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $cumplidas=Tarea::where('estados_id',2)->count();
        $en_proceso=Tarea::where('estados_id',3)->count();
        $pendientes=Tarea::where('estados_id',1)->count();
        //dd($cumplidas,$en_proceso,$pendientes);
        return view('home', compact('cumplidas','pendientes','en_proceso'));
    }

    public function index_u()
    {
        
        $id_empleado=empleado::where('users_id',auth()->user()->id)->get();
        $tareas_user=Atarea::where('empleados_id',$id_empleado[0]->id)->get();
        $cumpl=0;
        $no_cumpl=0;
        $en_pro=0;
        foreach($tareas_user as $tu)
        {
             if($tu->tareas->estados_id==2)
             {
                $cumpl++;
             }
             if($tu->tareas->estados_id==1)
             {
                $no_cumpl++;
             }
             if($tu->tareas->estados_id==3)
             {
                $en_pro++;
             }
        }
        //dd($id_empleado[0]->id, $tareas_user,$cumplidas,$no_cumplidas,$en_pro);
        return view('homeuser', compact('cumpl','no_cumpl','en_pro'));
    }
}
