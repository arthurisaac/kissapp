<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('factures', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->date('date');
            $table->foreignId('client')->references('id')->on('clients')->cascadeOnDelete();
            $table->string('numeroFacture');
            $table->string('objet')->nullable();
            $table->integer('numeroClient')->nullable();
            $table->double('montantTotal')->default(0);
            $table->double('fraisAnnexe')->default(0);
            $table->double('montantPaye')->default(0);
            $table->double('montantRestant')->default(0);
            $table->foreignId('boutique')->references('id')->on('boutiques')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('factures');
    }
}
