<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\tbl_receta;
use App\Models\tbl_cliente;
use App\Models\tbl_detalleordenproduccion;
use App\Models\tbl_usuarios;

class tbl_ordenproduccion extends Model
{
    use HasFactory;

    protected $table = 'tbl_ordenproduccion';
    protected $fillable = ['Fecha','Id_Cliente','Id_Empleado','Id_Receta','cantidad','estado'];
    protected $primaryKey = 'Consecutivo';
    public $timestamps = false;
    
    public function cliente()
    {
        return $this->belongsTo(tbl_cliente::class, 'Id_Cliente');
    }

    public function empleado()
    {
        return $this->belongsTo(tbl_usuarios::class, 'Id_Empleado');
    }

    public function receta()
    {
        return $this->belongsTo(tbl_receta::class, 'Id_Receta');
    }

    public function detalles()
    {
        return $this->hasOne(tbl_detalleordenproduccion::class, 'Consecutivo');
    }
   
}
