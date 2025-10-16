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
        Schema::create('barriers', function (Blueprint $table) {
            $table->id();
            $table->string('name', 128)->nullable();
            $table->unsignedSmallInteger('barrierport');
            $table->enum('direction', ['in', 'out']);
            $table->enum('mode', ['auto', 'manual'])->default('auto');
            $table->enum('status', ['opened', 'closed', 'none'])->nullable()->default('none');

            $table->timestamp('created_at')->useCurrent();
            $table->unsignedBigInteger('created_by');
            $table->timestamp('updated_at')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();

            $table->unique(['barrierport', 'direction']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barriers');
    }
};


