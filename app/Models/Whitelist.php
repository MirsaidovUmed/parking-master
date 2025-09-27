<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Whitelist extends Model
{
    use HasFactory;

    protected $table = "whitelists";

    protected $fillable = [
        'plate_number',
        'reason',
        'created_by',
        'updated_by',
        'deleted_by',
    ];
}
