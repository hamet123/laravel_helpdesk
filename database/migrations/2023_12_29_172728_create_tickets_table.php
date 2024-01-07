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
        Schema::create('tickets', function (Blueprint $table) {

            // $table->unsignedBigInteger('id')->unique()->default(rand(994392343,999999999));
            $table->id()->startingFrom(987364523);
            $table->foreignId('user_id')->constrained('users');
            $table->string('subject');
            $table->string('select_department');
            $table->text('description');
            $table->string('status')->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};