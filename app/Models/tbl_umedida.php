<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbl_umedida extends Model
{
    use HasFactory;

    protected $table = 'tbl_umedida';
<<<<<<< HEAD
    protected $fillabel = ['Unidad_Medida'];
=======
    protected $fillable = ['Unidad_Medida'];
>>>>>>> jero
    protected $primaryKey = 'Cod_UMedida';
    public $timestamps = false;
    

    public function productos() {
        return $this->hasMany(tbl_producto::class, 'Cod_Producto');
      }
}
