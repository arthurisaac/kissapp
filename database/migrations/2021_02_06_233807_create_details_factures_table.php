<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailsFacturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('details_factures', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->double('prix');
            $table->integer('quantite');
            $table->double('montant')->nullable();
            $table->foreignId('facture')->references('id')->on('factures')->cascadeOnDelete();
            $table->foreignId('produit')->references('id')->on('produits')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('details_factures');
    }
}
