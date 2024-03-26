<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbl_usuarios extends Model
{
    use HasFactory;

    protected $table = 'tbl_usuarios';
    protected $fillabel = ['Id_Empleado','tipo_documento','Nombre','Apellido','Telefono','Id_Rol'];
    protected $primarykey = 'Id_Empleado';
    public $timestamps = false;
}
