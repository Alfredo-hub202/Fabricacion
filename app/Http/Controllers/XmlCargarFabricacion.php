<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use DB;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use simplexml_load_file;

class XmlCargarFabricacion extends Controller
{

 //
 public function index()
 {

  $fecha = Carbon::now();

//   $from = 'file://phgnas/dinamicos/XML/EquiposNecesidades/';
  //   $from = dirname(__FILE__) . '/phgnas/dinamicos/XML/EquiposNecesidades//';
  //   dd($from);
  //   // $from = 'C:\Users\ARPEREZ.PHERGAL\Pictures\practica final';

//   $to = (public_path());

// //Abro el directorio que voy a leer
  //   $dir = opendir($from);

// //Recorro el directorio para leer los archivos que tiene
  //   while (($file = readdir($dir)) !== false) {
  //    //Leo todos los archivos excepto . y ..
  //    if (strpos($file, '.') !== 0) {
  //     //Copio el archivo manteniendo el mismo nombre en la nueva carpeta
  //     copy($from . '/' . $file, $to . '/' . $file);
  //    }
  //   }

  // RUTA DEL ARCHIVO XML
  $archivo = simplexml_load_file(public_path('PartesFabrica.xml'));

  // BORRAMOS LA TABLA en CASO DE QUE EXISTA ANTES

  Schema::drop('calendars', function ($table) {

   $table->foreign('equipo_id')->references('id')->on('equipos');
   $table->foreign('agrupacion_id')->references('id')->on('agrupaciones');
   $table->foreign('seccion_id')->references('id')->on('seccion');

   $table->dropColumn('agrupacion_id');
   $table->dropColumn('equipo_id');
   $table->dropColumn('seccion_id');
  });

  $sql_delete = Schema::drop('equipos');
  //   $sql_delete = Schema::drop('recursos');
  $sql_delete = Schema::drop('agrupaciones');
  $sql_delete = Schema::drop('secciones');

  // CREAMOS LA TABLA
  $sql_create = Schema::create('secciones', function (Blueprint $table) {
   $table->increments('id');
   $table->string('seccion')->nullable();
   $table->timestamps();
  });

  foreach ($archivo as $fabricacion) {

   DB::table('secciones')->insert([
    'seccion' => $fabricacion->note->seccion,
    'created_at' => $fecha,
    'updated_at' => $fecha,
   ]);
  }

  $results = DB::statement('ALTER IGNORE TABLE secciones ADD UNIQUE INDEX(seccion);');

  Schema::create('agrupaciones', function (Blueprint $table) {
   $table->increments('id');
   $table->string('nombre')->nullable();
   $table->integer("seccion_id")->unsigned();

   $table->foreign("seccion_id")->references("id")->on("secciones")
    ->onDelete("cascade")
    ->onUpdate("cascade");
   $table->timestamps();
  });

  foreach ($archivo as $fabricacion) {
   $sql_consulta_secciones = DB::table('secciones')->select('id')->where("seccion", "=", $fabricacion->note->seccion)->get();
   foreach ($sql_consulta_secciones as $seccion) {

   }
   DB::table('agrupaciones')->insert([
    'nombre' => $fabricacion->note->agrupacion,
    'seccion_id' => $seccion->id,
    'created_at' => $fecha,
    'updated_at' => $fecha,
   ]);
  }

  $results = DB::statement('ALTER IGNORE TABLE agrupaciones ADD UNIQUE INDEX(nombre);');

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

  foreach ($archivo as $fabricacion) {

   $codigo_color = $fabricacion->note->cod_equipo;

   $color_string = strval($codigo_color);

   //  dd($color_string);
   $array = [
    "#000080" => 'UAR 009',
    "#800080" => 'UAR 006',
    "#D8BFD8" => 'UAR 007',
    "#808000" => 'UAR 013',
    "#008000" => 'UAR 014',
    "#800000" => 'UAR 008',
    "#808080" => 'UAR 005',
    "#A52A2A" => 'ALMACEN',
    "#C0C0C0" => 'UDO 004',
    "#FF8C00" => 'UDO 003',
    "#9932CC" => 'UDO 007',
    "#FF69B4" => 'UDO 008',
    "#FFA500" => 'UES 004',
    "#008080" => 'UDO 006',
    "#F5DEB3" => 'UDO 018',
    "#00FFFF" => 'UFC 008',
    "#DC143C" => 'UES 001',
    "#6495ED" => 'UDO 010',
    "#006400" => 'UDO 010',
    "#9ACD32" => 'UAR 001',
    "#1E90FF" => 'UCT 002',
    "#1893FF" => 'UCT 001',
    "#c6606a" => 'UDO 017',
    "#40E0D0" => 'UES 002',

   ];

   $color = array_search($color_string, $array); // $clave = 2;

   $sql_consulta_agrupaciones = DB::table('agrupaciones')->select('id')->where("nombre", "=", $fabricacion->note->agrupacion)->get();
   foreach ($sql_consulta_agrupaciones as $agrupaciones) {

   }
   DB::table('equipos')->insert([
    'cod_equipo' => $fabricacion->note->cod_equipo,
    'nom_equipo' => $fabricacion->note->nom_equipo,
    'equipo' => $fabricacion->note->equipo,
    'agrupaciones_id' => $agrupaciones->id,
    'color' => $color,
    'created_at' => $fecha,
    'updated_at' => $fecha,

   ]);
  }

  $results = DB::statement('ALTER IGNORE TABLE equipos ADD UNIQUE INDEX(cod_equipo);');

  return \App::call('App\Http\Controllers\XmlCargarFabri@index');

 }

}
