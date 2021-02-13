<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProduitBoutiquesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produit_boutiques', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('boutique')->references('id')->on('boutiques')->onDelete('cascade');
            $table->foreignId('produit')->references('id')->on('produits')->onDelete('cascade');
            $table->integer('quantite')->default(0);
            $table->integer('alerte')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produit_boutiques');
    }
}
