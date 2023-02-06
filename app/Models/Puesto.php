<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\models\Area;

class Puesto extends Model
{
	use HasFactory;
	
    public $timestamps = true;

    protected $table = 'puestos';

    protected $fillable = ['nomenclatura','descripcion','areas_id'];

    public function area()
	{

		return $this->HasOne(Area::class,'id','areas_id');

	}

	
}


	
