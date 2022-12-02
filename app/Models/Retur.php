<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Retur extends Model
{
    use HasFactory;

    protected $table = 'tbl_retur';
    protected $primaryKey = 'id_retur';
    protected $guarded = [];
}
