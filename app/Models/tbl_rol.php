<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbl_rol extends Model
{
    use HasFactory;

    protected $table = 'tbl_rol';
    protected $fillable = ['Rol'];
    protected $primarykey = 'Id_Rol';
    public $timestamps = false;
}
