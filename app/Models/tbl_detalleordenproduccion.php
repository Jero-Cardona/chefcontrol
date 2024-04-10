<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\tbl_ordenproduccion;

class tbl_detalleordenproduccion extends Model
{
    use HasFactory;

    protected $table = 'tbl_detalleordenproduccion';
    protected $fillable = ['Consecutivo','Fecha_Pedido','Presentacion'];
    protected $primaryKey = 'Id_Detalle';
    public $timestamps = false;
    
    public function ordenProduccion()
    {
        return $this->belongsTo(tbl_ordenproduccion::class, 'Consecutivo');
    }
}
