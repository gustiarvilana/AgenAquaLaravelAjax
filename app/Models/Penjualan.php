<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    use HasFactory;

    protected $table = 'tbl_penjualan';
    protected $primaryKey = 'id_penjualan';
    protected $guarded = [];
}
