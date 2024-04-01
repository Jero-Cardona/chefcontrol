<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbl_tipoproducto extends Model
{
    use HasFactory;

    protected $table = 'tbl_tipoproducto';
    protected $fillable = ['Tipo'];
    protected $primarykey = 'Cod_Tipo';
    public $timestamps = false;
    
}
