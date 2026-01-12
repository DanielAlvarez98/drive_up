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
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->char('tipo', 1);
            $table->string('name', 50);
            $table->string('licen', 15)->nullable();
            $table->string('empresa', 50)->nullable();
            $table->char('categoria', 7)->nullable();
            $table->text('imagen')->nullable();
            $table->date('fecEmit')->nullable();
            $table->date('fecRenov')->nullable();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('car_id')->nullable()->constrained('cars')->cascadeOnDelete();
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
        Schema::dropIfExists('documents');
    }
};
