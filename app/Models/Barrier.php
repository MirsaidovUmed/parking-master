<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barrier extends Model
{
    use HasFactory;

    protected $table = 'barriers';

    protected $fillable = [
        'name',
        'barrierport',
        'direction',
        'mode',
        'status',
        'created_by',
        'updated_by',
        'deleted_by',
    ];
}


