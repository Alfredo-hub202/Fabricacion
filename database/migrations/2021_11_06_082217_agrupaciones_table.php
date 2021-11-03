<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AgrupacionesTable extends Migration
{
 /**
  * Run the migrations.
  *
  * @return void
  */
 public function up()
 {
  Schema::create('agrupaciones', function (Blueprint $table) {
   $table->increments('id');
   $table->string('nombre')->nullable();
   $table->integer("seccion_id")->unsigned();

   $table->foreign("seccion_id")->references("id")->on("secciones")
    ->onDelete("cascade")
    ->onUpdate("cascade");
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
  Schema::dropIfExists('agrupaciones');
 }
}
