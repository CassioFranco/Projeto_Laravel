<?php

use App\Enums\SupportStatus;
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
        Schema::create('supports', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('idade');
            $table->enum('status', array_column(SupportStatus::cases(), 'name'));
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->text('inventario')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('support');
    }
};
