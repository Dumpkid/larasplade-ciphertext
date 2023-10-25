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
        //
        Schema::create('cipherteks', function (Blueprint $table) {
            $table->id();
            $table->string('plainteks');
            $table->integer('enkripsi_key');
            $table->string('cipherteks');
            $table->integer('dekripsi_key');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('cipherteks');
    }
};
