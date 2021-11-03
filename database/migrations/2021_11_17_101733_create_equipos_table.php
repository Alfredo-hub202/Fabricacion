<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEquiposTable extends Migration
{
 /**
  * Run the migrations.
  *
  * @return void
  */
 public function up()
 {
  Schema::create('equipos', function (Blueprint $table) {
   $table->increments('id');
   $table->string('cod_equipo')->nullable();
   $table->string('nom_equipo')->nullable();
   $table->string('equipo')->nullable();
   $table->string('color')->nullable();
   $table->integer("agrupaciones_id")->unsigned();
   $table->timestamps();


   $table->foreign("agrupaciones_id")->references("id")->on("agrupaciones")
   ->onDelete("cascade")
   ->onUpdate("cascade");
  });

  
 }

 /**
  * Reverse the migrations.
  *
  * @return void
  */
 public function down()
 {
  Schema::dropIfExists('equipos');
 }
}
