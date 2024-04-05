<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbl_ordenproduccion extends Model
{
    use HasFactory;

    protected $table = 'tbl_ordenproduccion';
    protected $fillable = ['Fecha','Id_Cliente','Id_Empleado','Id_Receta','cantidad','estado'];
    protected $primaryKey = 'Consecutivo';
    public $timestamps = false;
    
}
