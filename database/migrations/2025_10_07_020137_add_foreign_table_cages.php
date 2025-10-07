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
        Schema::table('animals', function (Blueprint $table) {
            // Tambah kolom jika belum ada
            $table->unsignedBigInteger('cage_id')->after('id')->nullable();

            // Tambah foreign key
            $table->foreign('cage_id')
                ->references('id')
                ->on('cages')
                ->onDelete('cascade'); // optional: bisa juga 'set null', 'restrict', dll
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('animals', function (Blueprint $table) {
            $table->dropForeign(['cage_id']);
            $table->dropColumn('cage_id');
        });
    }
};
