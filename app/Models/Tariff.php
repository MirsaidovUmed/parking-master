<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tariff extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'price_per_step',
        'is_active',
        'step_start',
        'step_end',
        // p0..p10 должны быть fillable, так как мы пишем в них JSON
        'p0','p1','p2','p3','p4','p5','p6','p7','p8','p9','p10',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    // касты — если нужно, можно добавить
    protected $casts = [
        'is_active' => 'boolean',
    ];
}
