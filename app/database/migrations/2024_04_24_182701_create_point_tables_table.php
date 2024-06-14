<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use function Laravel\Prompts\table;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('point_tables', function (Blueprint $table) {
            $table->id();
            $table->index('type');
            $table->index('id');
            $table->index('point_value');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('type');
            $table->integer('duration');
            $table->boolean('is_streaked');
            $table->integer('streak')->nullable();
            $table->integer('max_streak')->nullable();
            $table->integer('point_value');
            $table->boolean('is_completed');
            $table->timestamps();    
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('point_tables');
    }
};
