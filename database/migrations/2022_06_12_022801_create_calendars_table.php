<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCalendarsTable extends Migration
{
 /**
  * Run the migrations.
  *
  * @return void
  */
 public function up()
 {
  Schema::create('calendars', function (Blueprint $table) {
   $table->increments('id');
   $table->string('recurso')->nullable();
   $table->integer('seccion_id')->unsigned();
   $table->integer('agrupacion_id')->unsigned();
   $table->integer('equipo_id')->unsigned();
   $table->string('unidades_media_equipo')->nullable();
   $table->string('unidades_fabricar')->nullable();
   $table->string('unidades_brutas')->nullable();
   $table->string('horas_necesarias')->nullable();
   $table->date('fecha_compromiso_cli')->nullable();
   $table->date('fecha_compromiso_fab')->nullable();
   $table->date('fecha_compromiso_fab_1t')->nullable();
   $table->date('fecha_compromiso_fab_2t')->nullable();
   $table->date('fecha_fab')->nullable();
   $table->date('fecha_fab_1t')->nullable();
   $table->date('fecha_fab_2t')->nullable();
   $table->string('dias')->nullable();
   $table->string('dias1t')->nullable();
   $table->string('dias2t')->nullable();
   $table->string('tipo_necesidad')->nullable();
   $table->string('pedido')->nullable();
   $table->string('cliente_codigo')->nullable();
   $table->string('cliente_nombre')->nullable();
   $table->string('cliente')->nullable();
   $table->string('articulo_codigo')->nullable();
   $table->string('articulo_nombre')->nullable();
   $table->string('articulo')->nullable();
   $table->string('articulo_marca')->nullable();
   $table->string('es_desglose_necesidad')->nullable();
   $table->string('articulo_padre')->nullable();
   $table->string('articulo_fabricar')->nullable();
   $table->string('establecimiento')->nullable();
   $table->string('pais')->nullable();
   $table->string('gama')->nullable();
   $table->string('parte')->nullable();
   $table->string('color')->nullable();
   $table->timestamps();

   $table->foreign("agrupacion_id")->references("id")->on("agrupaciones")
    ->onDelete("cascade")
    ->onUpdate("cascade");

   $table->foreign("equipo_id")->references("id")->on("equipos")
    ->onDelete("cascade")
    ->onUpdate("cascade");

   $table->foreign("seccion_id")->references("id")->on("secciones")
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
  Schema::dropIfExists('calendars');
 }
}
