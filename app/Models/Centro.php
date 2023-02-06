<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Centro extends Model
{
    use HasFactory;
    public $timestamps = true;

    protected $table = 'centros';

    protected $fillable = ['descripcion'];
}
