<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\models\Puesto;
use App\models\User;
class Empleado extends Model
{
	use HasFactory;
	
    public $timestamps = true;

    protected $table = 'empleados';

    protected $fillable = ['nombre','ap','am','curp','rfc','puestos_id','email','users_id'];
    public function puesto()
	{

		return $this->HasOne(Puesto::class,'id','puestos_id');

	}
    public function usuario()
	{

		return $this->HasOne(User::class,'id','users_id');

	}
}
