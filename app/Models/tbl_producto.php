<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbl_producto extends Model
{
    use HasFactory;

    protected $table = 'tbl_producto';
    protected $fillabel = ['Cod_Producto','Nombre','imagen','Stock_Minimo','Stock_Maximo','Fecha_Vencimiento','Costo','Cod_Tipo','Ubicacion','Cod_UMedida','Precio_Venta','Existencia','IVA'];
    protected $primaryKey = 'Cod_Producto';
    public $timestamps = false;

    
}

