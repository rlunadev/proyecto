<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AccesoDetalle extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('acceso_detalles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('sistema_id')->unsigned();
            $table->string('descripcion');
            //Roles
            $table->enum('type',['superAdmin','admin','user'])->default('user');

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('sistema_id')->references('id')->on('sistemas')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('acceso_detalles');
    }
}
