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
        Schema::create('transactions', function (Blueprint $table) {
            $table->uuid('id')->primary(); // Utilisation de UUID pour l'identifiant
            $table->string('state'); // État de la transaction (PENDING, COMPLETED, etc.)
            $table->integer('amount'); // Montant de la transaction
            $table->string('channel'); // Canal de paiement
            $table->string('reference'); // Référence de la transaction
            $table->string('pay_id')->nullable(); // Identifiant de paiement (peut être null)
            $table->uuid('medecin_id'); // Référence à l'ID du médecin
            $table->timestamps(); // Création des colonnes `created_at` et `updated_at`

            $table->foreign('medecin_id')->references('id')->on('medecins')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
};
