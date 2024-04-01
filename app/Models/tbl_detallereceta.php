<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class tbl_detallereceta extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'tbl_detallereceta';
    protected $fillable = ['Id_Receta','Cod_Producto','Cantidad','Cod_UMedida'];
    protected $primarykey = 'Consecutivo';
    public $timestamps = false;
    
}
