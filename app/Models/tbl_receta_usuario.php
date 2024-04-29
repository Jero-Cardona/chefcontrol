<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbl_receta_usuario extends Model
{
    use HasFactory;

    protected $table = 'tbl_receta_usuario';
    protected $fillable = ['id','receta_id','usuario_id'];
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function receta()
{
    return $this->belongsTo(tbl_receta::class);
}

public function user()
{
    return $this->belongsTo(tbl_usuarios::class);
}

public function detallesReceta()
{
    return $this->hasMany(tbl_detallereceta::class, 'Id_Receta', 'Id_Receta');
}
}
