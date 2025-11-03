<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vehicle_events', function (Blueprint $table) {
            $table->id();
            $table->string('request_id')->unique()->index();
            $table->unsignedBigInteger('camera_id');
            $table->string('camera_ip', 64);
            $table->string('plate_number', 32)->index();
            $table->string('plate_color', 32)->nullable();
            $table->string('vehicle_color', 32)->nullable();
            $table->string('vehicle_type', 32)->nullable();
            $table->string('country', 8)->nullable();
            $table->text('image_full_path_in')->nullable();
            $table->text('image_plate_path_in')->nullable();
            $table->text('image_full_path_out')->nullable();
            $table->text('image_plate_path_out')->nullable();
            $table->timestamp('status_in_time')->index();
            $table->timestamp('status_out_time')->nullable();
            $table->bigInteger('duration_parking')->nullable();
            $table->string('payment_status', 16)->default('PENDING');
            $table->string('payment_bank', 64)->nullable();
            $table->bigInteger('payment_amount')->nullable();
            $table->string('payment_dc_order_id', 64)->nullable();
            $table->string('payment_neru_transaction_id', 64)->nullable();
            $table->string('phone_number', 64)->nullable();
            $table->string('p0')->nullable();
            $table->string('p1')->nullable();
            $table->string('p2')->nullable();
            $table->string('p3')->nullable();
            $table->string('p4')->nullable();
            $table->string('p5')->nullable();
            $table->string('p6')->nullable();
            $table->string('p7')->nullable();
            $table->string('p8')->nullable();
            $table->string('p9')->nullable();
            $table->string('p10')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vehicle_events');
    }
};
