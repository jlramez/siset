<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\models\Prioridade;
use App\models\Area;


class Actividade extends Model
{
	use HasFactory;
	
    public $timestamps = true;

    protected $table = 'actividades';

    protected $fillable = ['nombre','descripción','id_prioridad','areas_id','avance'];
    public function prioridades()
	{

		return $this->HasOne(Prioridade::class,'id','id_prioridad');

	}
    public function areas()
	{

		return $this->HasOne(Area::class,'id','areas_id');

	}
//prueba git	...
}
