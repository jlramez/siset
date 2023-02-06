<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    use HasFactory;

    static $rules= [
      'title'=> 'required',
      'descripcion'=> 'required',
      'start' => 'required',
      'end' => 'required',
      'areas_id' => 'required'

    ];

    public $timestamps = true;

    protected $table = 'eventos';

    protected $fillable = ['title','descripcion','start','end','areas_id'];
}
