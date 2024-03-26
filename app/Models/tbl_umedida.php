<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbl_umedida extends Model
{
    use HasFactory;

    protected $table = 'tbl_umedida';
    protected $fillabel = ['Unidad_Medida'];
    protected $primarykey = 'Cod_UMedida';
    public $timestamps = false;
    
}
