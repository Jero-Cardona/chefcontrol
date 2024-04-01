<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbl_tareas extends Model
{
    use HasFactory;

    protected $table = 'tbl_tareas';
    protected $fillable = ['nombre','id_formato'];
    protected $primarykey = 'id';
    public $timestamps = false;
}
