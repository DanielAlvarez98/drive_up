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
        Schema::create('maintenances', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->string('marca', 50);
            $table->string('numero', 15)->nullable();
            $table->decimal('price');
            $table->date('fecEmit')->nullable();
            $table->date('fecRenov')->nullable();
            $table->text('imagen')->nullable();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('car_id')->constrained('cars')->cascadeOnDelete();
            $table->boolean('notified_warning')->default(false);
            $table->boolean('notified_expired')->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maintenances');
    }
};
