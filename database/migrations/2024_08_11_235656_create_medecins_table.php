<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medecins', function (Blueprint $table) {
            $table->uuid('id')->primary()->default(Str::uuid());
            $table->string('state')->default('PENDING');
            $table->string('reference');
            $table->string('nom');
            $table->string('prenom');
            $table->date('date_naissance');
            $table->string('lieu_naissance');
            $table->string('nationalite');
            $table->string('specialite');
            $table->string('diplomes')->nullable();
            $table->string('attestation_service')->nullable();
            $table->string('photos_identite')->nullable();
            $table->string('acte_naissance')->nullable();
            $table->string('casier_judiciaire')->nullable();
            $table->string('contrat_travail')->nullable();
            $table->string('certificat_nationalite')->nullable();
            $table->string('fiche_identification')->nullable();
            $table->string('attestation_equivalence')->nullable();
            $table->string('authentification_diplomes')->nullable();
            $table->string('autres_diplomes')->nullable();
            $table->string('attestation_radiation')->nullable();
            $table->string('attestation_conduite')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('medecins');
    }
};
