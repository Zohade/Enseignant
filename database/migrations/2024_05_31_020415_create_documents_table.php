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
            $table->enum('type_doc', ['guide', 'fiche']);
            $table->string('titre');
            $table->string('fichier');
            $table->string('desc');
            $table->enum('classe', ['CI', 'CP', 'CE1', 'CE2', 'CM1', 'CM2']);
            $table->boolean('payant');
            $table->integer('prix');
            $table->string('matiere');
            $table->string('SA');
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