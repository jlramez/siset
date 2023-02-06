<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\models\Empleado;
use App\models\Tarea;

class Atarea extends Model
{
	use HasFactory;
	
    public $timestamps = true;

    protected $table = 'atareas';

    protected $fillable = ['actividades_id','tareas_id','empleados_id'];
 public function tareas()
	{

		return $this->HasOne(Tarea::class,'id','tareas_id');

	}
    public function empleados()
	{

		return $this->HasOne(Empleado::class,'id','empleados_id');	
	}
}
