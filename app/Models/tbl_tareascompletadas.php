<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbl_tareascompletadas extends Model
{
    use HasFactory;

    protected $table = 'tbl_tareascompletadas';
    protected $fillable = ['Id_Empleado', 'id_tarea', 'fecha'];
    protected $primarykey = 'id';
    public $timestamps = false;

    
}

