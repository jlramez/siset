<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tarea;
use App\Models\User;


class Comentario extends Model
{
    use HasFactory;
    public $timestamps = true;

    protected $table = 'comentarios';

    protected $fillable = ['id_tareas','id_users','contenido','nuevo'];
    public function tareas()
	{

		return $this->HasOne(Tarea::class,'id','id_tareas');

	}

    public function users()
	{

		return $this->HasOne(User::class,'id','id_users');

	}

}