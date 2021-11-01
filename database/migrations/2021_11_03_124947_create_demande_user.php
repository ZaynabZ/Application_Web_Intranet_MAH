<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDemandeUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('demande_user', function (Blueprint $table) {
            $table->bigInteger('demande_id')->unsigned()->unique();
            $table->bigInteger('user_id')->unsigned()->unique();

            $table->foreign('demande_id')
              ->references('id')
              ->on('demandes')->onDelete('cascade')->change();
              
            $table->foreign('user_id')
              ->references('id')
              ->on('users')->onDelete('cascade')->change();
            
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
