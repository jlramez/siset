<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Actividade;
use App\Models\Atarea;
use App\Models\Estado;


class Tarea extends Model
{
	use HasFactory;
	
    public $timestamps = true;

    protected $table = 'tareas';

    protected $fillable = ['descripcion','actividades_id','estados_id', 'ended_at'];
    public function actividades()
	{

		return $this->HasOne(Actividade::class,'id','actividades_id');

	}
    public function atareas()
	{

		return $this->HasOne(Atarea::class,'id','tareas_id');

	}
	public function estados()
	{

		return $this->HasOne(Estado::class,'id','estados_id');

	}
	
}
