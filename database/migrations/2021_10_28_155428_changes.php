<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Changes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('conges', function (Blueprint $table){
            $table->dropForeign(['user_id']);
            $table->foreign('user_id')
            ->references('id')->on('users')
            ->onDelete('cascade')
            ->onUpdate('cascade');
        });
        Schema::table('users', function (Blueprint $table){

            $table->dropForeign(['service_id']);
            $table->foreign('service_id')
            ->references('id')->on('services')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->dropForeign(['role_id']);
            $table->foreign('role_id')
            ->references('id')->on('roles')
            ->onDelete('cascade')
            ->onUpdate('cascade');
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
