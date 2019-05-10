<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Producto extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->integer('cantidad'); 
            $table->decimal('precio');
            $table->decimal('codigo');
            $table->integer('stockMinimo');
            $table->integer('unidadId')->unsigned();
            $table->integer('categoriaId')->unsigned();
            $table->integer('proveedorId')->unsigned();
            $table->integer('almacenId')->unsigned();
           
            $table->foreign('unidadId')->references('id')->on('unidades')->onDelete('cascade');
            $table->foreign('categoriaId')->references('id')->on('categorias')->onDelete('cascade');
            $table->foreign('proveedorId')->references('id')->on('proveedores')->onDelete('cascade');
            $table->foreign('almacenId')->references('id')->on('almacenes')->onDelete('cascade');
            
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
        Schema::drop('productos');
    }
}
