<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbl_umedida extends Model
{
    use HasFactory;

    protected $table = 'tbl_umedida';
    protected $fillable = ['Unidad_Medida'];
    protected $primaryKey = 'Cod_UMedida';
    public $timestamps = false;
    

    public function productos() {
        return $this->hasMany(tbl_producto::class, 'Cod_Producto');
      }
}
