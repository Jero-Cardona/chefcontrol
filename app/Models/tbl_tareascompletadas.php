<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbl_tareascompletadas extends Model
{
    use HasFactory;

    protected $table = 'tbl_tareascompletadas';
    protected $fillable = ['Id_Empleado', 'id_tarea', 'fecha'];
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function usuario() {
        return $this->belongsTo(tbl_usuarios::class, 'Id_Empleado');
      }
      
      public function tarea() {
        return $this->belongsTo(tbl_tareas::class, 'id_tarea');
      }  

}

