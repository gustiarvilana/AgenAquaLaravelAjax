<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Galon extends Model
{
    use HasFactory;

    protected $table = 'tbl_galon';
    protected $primaryKey = 'id_galon';
    protected $guarded = [];
}
