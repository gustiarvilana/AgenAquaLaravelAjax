<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HargaJenis extends Model
{
    use HasFactory;

    protected $table = 'tbl_harga_jenis';
    protected $primaryKey = 'id_harga_jenis';
    protected $guarded = [];
}
