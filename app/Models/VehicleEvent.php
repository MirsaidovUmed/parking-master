<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleEvent extends Model
{
    use HasFactory;

    protected $fillable = [
        'request_id',
        'camera_id',
        'camera_ip',
        'plate_number',
        'plate_color',
        'vehicle_color',
        'vehicle_type',
        'country',
        'image_full_path_in',
        'image_plate_path_in',
        'image_full_path_out',
        'image_plate_path_out',
        'status_in_time',
        'status_out_time',
        'duration_parking',
        'payment_status',
        'payment_bank',
        'payment_amount',
        'payment_dc_order_id',
        'payment_neru_transaction_id',
        'phone_number',
        'created_by',
    ];

    protected $casts = [
        'status_in_time' => 'datetime',
        'status_out_time' => 'datetime',
        'duration_parking' => 'integer',
    ];
}
