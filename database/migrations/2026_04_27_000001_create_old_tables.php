<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
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

        Schema::create('medicament', function (Blueprint $table) {
            $table->increments('numM');
            $table->string('nom');
            $table->integer('quantite');
        });

        Schema::create('chambre', function (Blueprint $table) {
            $table->increments('num');
            $table->integer('id_p');
            $table->integer('id_e');
        });

        Schema::create('facture', function (Blueprint $table) {
            $table->increments('num');
            $table->float('Montant');
            $table->integer('id_p');
        });

        Schema::create('donneur', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nom');
            $table->string('prenom');
            $table->integer('numero');
            $table->string('gs');
        });

        Schema::create('cong', function (Blueprint $table) {
            $table->increments('num_cn');
            $table->integer('id_em');
            $table->date('dated');
            $table->date('datef');
        });

        Schema::create('stocks', function (Blueprint $table) {
            $table->string('gs')->primary();
            $table->integer('quantite');
        });

        Schema::create('consultation', function (Blueprint $table) {
            $table->increments('num');
            $table->date('date');
            $table->integer('id_p');
        });

        Schema::create('ordonnance', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date_ord');
            $table->integer('id_em');
        });

        Schema::create('salaire', function (Blueprint $table) {
            $table->increments('id');
            $table->float('salaire');
        });

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
