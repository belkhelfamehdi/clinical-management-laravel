<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Create patient table
        Schema::create('patient', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nom');
            $table->string('prenom');
            $table->date('daten');
            $table->string('gen');
            $table->integer('num');
            $table->string('email');
            $table->string('addr');
            $table->string('gs');
            $table->timestamps();
        });

        // Create employe table
        Schema::create('employe', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nom');
            $table->string('prenom');
            $table->date('daten');
            $table->date('dateem');
            $table->string('gen');
            $table->integer('num');
            $table->string('email');
            $table->string('fonction')->nullable();
            $table->timestamps();
        });

        // Create medicament table
        Schema::create('medicament', function (Blueprint $table) {
            $table->increments('numM');
            $table->string('nom');
            $table->integer('quantite');
        });

        // Create chambre table
        Schema::create('chambre', function (Blueprint $table) {
            $table->increments('num');
            $table->integer('id_p');
            $table->integer('id_e');
        });

        // Create facture table
        Schema::create('facture', function (Blueprint $table) {
            $table->increments('num');
            $table->float('Montant');
            $table->integer('id_p');
        });

        // Create donneur table
        Schema::create('donneur', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nom');
            $table->string('prenom');
            $table->integer('numero');
            $table->string('gs');
        });

        // Create cong table
        Schema::create('cong', function (Blueprint $table) {
            $table->increments('num_cn');
            $table->integer('id_em');
            $table->date('dated');
            $table->date('datef');
        });

        // Create stocks table
        Schema::create('stocks', function (Blueprint $table) {
            $table->string('gs')->primary();
            $table->integer('quantite');
        });

        // Create consultation table
        Schema::create('consultation', function (Blueprint $table) {
            $table->increments('num');
            $table->date('date');
            $table->integer('id_p');
        });

        // Create ordonnance table
        Schema::create('ordonnance', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date_ord');
            $table->integer('id_em');
        });

        // Create salaire table
        Schema::create('salaire', function (Blueprint $table) {
            $table->increments('id');
            $table->float('salaire');
        });

        // Create admin table
        Schema::create('admin', function (Blueprint $table) {
            $table->increments('id');
            $table->string('fullname');
            $table->string('user');
            $table->string('pwd');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('patient');
        Schema::dropIfExists('employe');
        Schema::dropIfExists('medicament');
        Schema::dropIfExists('chambre');
        Schema::dropIfExists('facture');
        Schema::dropIfExists('donneur');
        Schema::dropIfExists('cong');
        Schema::dropIfExists('stocks');
        Schema::dropIfExists('consultation');
        Schema::dropIfExists('ordonnance');
        Schema::dropIfExists('salaire');
        Schema::dropIfExists('admin');
    }
};
