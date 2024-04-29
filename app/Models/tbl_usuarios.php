<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

use Illuminate\Database\Eloquent\Model;

class tbl_usuarios extends Model 
{
    use HasFactory;

    protected $table = 'tbl_usuarios';
    protected $fillable = ['Id_Empleado','tipo_documento','Nombre','Apellido','Telefono', 'password','Id_Rol','estado'];
    protected $primaryKey = 'Id_Empleado';
    public $timestamps = false;

    public function tipoRol() {
        return $this->belongsTo(tbl_rol::class, 'Id_Rol');
      }

      public function tareascompletadas() {
        return $this->hasMany(tbl_tareascompletadas::class, 'Id_Empleado');
      }

      public function recetas() {
        return $this->hasMany(tbl_receta::class, 'Id_Empleado');
    }

    public function recetasLog()
{
    return $this->hasMany(tbl_receta_usuario::class, 'usuario_id');
}
}
