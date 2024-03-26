<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbl_receta extends Model
{
    use HasFactory;

    protected $table = 'tbl_receta';
    protected $fillabel = ['Id_Receta','Nombre','Descripcion','Costo_Total','Contribucion','Estado','imagen'];
    protected $primarykey = 'Id_Receta';
    public $timestamps = false;
    
}
