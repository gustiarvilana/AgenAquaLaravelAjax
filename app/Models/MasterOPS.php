<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterOPS extends Model
{
    use HasFactory;

    protected $table = 'tbl_master_ops';
    protected $primaryKey = 'id_master_ops';
    protected $guarded = [];
}
