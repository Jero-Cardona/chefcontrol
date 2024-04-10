<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbl_rol extends Model
{
    use HasFactory;

    protected $table = 'tbl_rol';
    protected $fillable = ['Rol'];
    protected $primaryKey = 'Id_Rol';
    public $timestamps = false;

    public function usuarios() {
        return $this->hasMany(tbl_usuarios::class, 'Id_Empleado');
      }

}
