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
        Schema::create('attentes', function (Blueprint $table) {
            $table->id();
            $table->string('dateCreation'); 
            $table->string('anneeAcademique'); 
            $table->string('numeroUnique')->unique(); 
            $table->foreignId('typeDocument_id')->constrained('type_documents')->onUpdate('cascade')->onDelete('cascade'); 
            $table->foreignId('user_id')->constrained()->onUpdate('cascade')->onDelete('cascade'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attentes');
    }
};
