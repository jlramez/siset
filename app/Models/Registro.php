<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Servicio;
use App\Models\Centro;

class Registro extends Model
{
	use HasFactory;
	
    public $timestamps = true;

    protected $table = 'registros';

    protected $fillable = ['nombre','ap','am','edad','primera_vez','servicios_id', 'centros_id', 'Observaciones'];
    public function centros()
	{

		return $this->HasOne(Centro::class,'id','centros_id');

	}

    public function servicios()
	{

		return $this->HasOne(Servicio::class,'id','centros_id');

	}
}
