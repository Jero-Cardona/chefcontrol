<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbl_ordenproduccion extends Model
{
    use HasFactory;

    protected $table = 'tbl_ordenproduccion';
    protected $fillabel = ['Fecha','Id_Cliente','Id_Empleado'];
    protected $primarykey = 'Consecutivo';
    public $timestamps = false;
    
}
