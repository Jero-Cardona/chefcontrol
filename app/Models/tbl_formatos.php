<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbl_formatos extends Model
{
    use HasFactory;

    protected $table = 'tbl_formatos';
    protected $fillabel = ['tipo_formato'];
    protected $primarykey = 'id_formato';
    public $timestamps = false;
 
}
