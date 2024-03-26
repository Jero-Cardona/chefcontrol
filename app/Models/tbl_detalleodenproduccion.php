<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbl_detalleordenproduccion extends Model
{
    use HasFactory;

    protected $table = 'tbl_detalleordenproduccion';
    protected $fillabel = ['Id_Detalle','Fecha_Pedido','Presentacion'];
    protected $primarykey = 'Consecutivo';
    public $timestamps = false;
    
}
