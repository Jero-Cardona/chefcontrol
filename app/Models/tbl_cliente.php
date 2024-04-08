<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbl_cliente extends Model
{
    use HasFactory;

    protected $table = 'tbl_cliente';
    protected $fillable = ['Tipo_identificacion','Nombre','Apellido','Telefono', 'estado'];
    protected $primaryKey = 'Id_Cliente';
    public $timestamps = false;
    
}
