<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class tbl_detallereceta extends Model
{
    use HasFactory;
    

    protected $table = 'tbl_detallereceta';
    protected $fillabel = ['Id_Receta','Cod_Producto','Cantidad','Cod_UMedida'];
    protected $primaryKey = 'Consecutivo';
    public $timestamps = false;
 
    public function receta()
    {
        return $this->belongsTo(tbl_receta::class,'Id_Receta');
    }

    public function producto()
    {
        return $this->belongsTo(tbl_producto::class, 'Cod_Producto');
    }

    public function unidadMedida()
    {
        return $this->belongsTo(tbl_umedida::class, 'Cod_UMedida');
    }
    
}
