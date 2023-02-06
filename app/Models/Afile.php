<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\File;
use App\Models\User;

class Afile extends Model
{
    use HasFactory;
    public $timestamps = true;

    protected $table = 'afiles';

    protected $fillable = ['id_files','id_tareas','id_users'];
    public function files()
	{

		return $this->HasOne(File::class,'id','id_files');

	}
    public function users()
	{

		return $this->HasOne(user::class,'id','id_users');

	}

}