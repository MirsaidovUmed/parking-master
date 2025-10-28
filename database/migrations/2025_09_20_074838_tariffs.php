<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tariffs', function (Blueprint $table) {
            $table->id();
            $table->string('name', 64)->unique();
            $table->integer('price_per_step')->nullable();
            $table->boolean('is_active')->default(true);
            $table->integer('step_start')->nullable();
            $table->integer('step_end')->nullable();
            $table->float('coefficient', 10,2)->nullable();
            $table->float('coefficient_per_step', 10,2)->nullable();
            $table->integer('minute')->nullable();

            // 🔹 связь с зоной
            $table->unsignedBigInteger('zone_id')->nullable();
            $table->foreign('zone_id')->references('id')->on('zones')->onDelete('set null');

            // 🔹 шаги
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

            // 🔹 служебные поля
            $table->timestamps();
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->softDeletes();
            $table->unsignedBigInteger('deleted_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tariffs');
    }
};
