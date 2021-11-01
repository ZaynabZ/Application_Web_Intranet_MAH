<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveUniqueConstraintUserDemandeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //You should create column before creating a foreign key:
        Schema::dropIfExists('demande_user');
        Schema::create('demande_user', function (Blueprint $table) {

            $table->id();
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->change();
            $table->integer('demande_id')->unsigned();
            $table->foreign('demande_id')->references('id')->on('demandes')->onDelete('cascade')->change();
            $table->enum('etat', ['En cours', 'Réalisée'])->default('En cours');
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
        Schema::dropIfExists('demande_user');

    }
}
