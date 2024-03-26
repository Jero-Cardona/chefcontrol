<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbl_cliente extends Model
{
    use HasFactory;

    protected $table = 'tbl_cliente';
    protected $fillabel = ['Tipo_identificacion','Nombre','Apellido','Telefono', 'estado'];
    protected $primarykey = 'Id_Cliente';
    public $timestamps = false;
    
}
