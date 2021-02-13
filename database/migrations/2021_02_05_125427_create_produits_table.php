<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProduitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produits', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('ref');
            $table->string('libelle')->nullable();
            $table->string('designation')->nullable();
            $table->integer('quantite')->default(0);
            $table->integer('alerte')->default(2);
            $table->integer('prix_gros')->default(0);
            $table->integer('prix_semi')->default(0);
            $table->integer('prix_details')->default(0);
            $table->foreignId('categorie')->references('id')->on('categorie')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produits');
    }
}
