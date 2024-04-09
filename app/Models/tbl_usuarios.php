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
    protected $fillable = ['Id_Empleado','tipo_documento','Nombre','Apellido','Telefono', 'password','Id_Rol'];
    protected $primaryKey = 'Id_Empleado';
    public $timestamps = false;

    public function tipoRol() {
        return $this->belongsTo(tbl_rol::class, 'Id_Rol');
      }
}
