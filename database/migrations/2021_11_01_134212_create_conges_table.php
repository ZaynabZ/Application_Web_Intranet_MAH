<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCongesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conges', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('service_id')->unsigned();
            $table->datetime('date_debut');
            $table->datetime('date_fin');
            $table->text('justification');
            $table->text('motif');
            $table->enum('etat', ['Rejetée', 'En Cours', 'Validée'])->default('En Cours');

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('table_conges');
    }
}
