<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('meals', function (Blueprint $table) {
            $table->id();
<<<<<<< HEAD
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
=======
             $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('mess_id');
>>>>>>> 90a3b70c5a23fbe29cd509bded00a588c0f43132
            $table->date('date');
            $table->decimal('breakfast', 4, 1)->default(0);
            $table->decimal('lunch', 4, 1)->default(0);
            $table->decimal('dinner', 4, 1)->default(0);
            $table->timestamps();
            $table->unique(['user_id', 'date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meals');
    }
};
