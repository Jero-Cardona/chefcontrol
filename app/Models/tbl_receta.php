<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbl_receta extends Model
{
    use HasFactory;

    protected $table = 'tbl_receta';
    protected $fillable = ['Id_Receta','Nombre','Descripcion','Costo_Total','Contribucion','Estado','imagen','etapa'];
    protected $primaryKey = 'Id_Receta';
    public $timestamps = false;
    
    public function detallesReceta()
    {
        return $this->hasMany(tbl_detallereceta::class, 'Id_Receta', 'Id_Receta');
    }
   
}
