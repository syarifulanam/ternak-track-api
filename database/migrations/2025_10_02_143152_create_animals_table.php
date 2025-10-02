<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('animals', function (Blueprint $table) {
            $table->id();
            $table->string('qr_code')->unique();
            $table->string('species');
            $table->date('birth_date')->nullable();
            $table->enum('gender', ['male', 'female']);
            $table->string('status')->default('alive');

            $table->unsignedBigInteger('sire_id')->nullable();
            $table->unsignedBigInteger('dam_id')->nullable();

            $table->unsignedBigInteger('cage_id')->nullable();

            $table->timestamps();

            $table->foreign('sire_id')->references('id')->on('animals')->onDelete('set null');
            $table->foreign('dam_id')->references('id')->on('animals')->onDelete('set null');
            $table->foreign('cage_id')->references('id')->on('cages')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('animals');
    }
};
