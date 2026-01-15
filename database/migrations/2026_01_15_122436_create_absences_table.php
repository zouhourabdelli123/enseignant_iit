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
    Schema::create('absences', function (Blueprint $table) {
        $table->id();
        $table->dateTime('date_heure');
        $table->dateTime('date_heure_fin')->nullable();

        $table->unsignedBigInteger('id_enseignant');
        $table->unsignedBigInteger('id_etudiant');
        $table->unsignedBigInteger('id_module');

        $table->boolean('isPresent')->default(false);
        $table->string('etat')->nullable();
        $table->string('type')->nullable();

        $table->timestamps();

/*         $table->foreign('id_enseignant')->references('id')->on('enseignants')->onDelete('cascade');
        $table->foreign('id_etudiant')->references('id')->on('etudiants')->onDelete('cascade');
        $table->foreign('id_module')->references('id')->on('modules')->onDelete('cascade'); */
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absences');
    }
};
