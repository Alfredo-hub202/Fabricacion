<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use DB;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Redirect;
use simplexml_load_file;

class XmlCargarFabri extends Controller
{

 //
 public function index()
 {

  $fecha = Carbon::now();
// Crearndo Tabla Calendars
  Schema::create('calendars', function (Blueprint $table) {
   $table->increments('id');
   $table->string('recurso')->nullable();
   $table->integer('seccion_id')->unsigned();
   $table->integer('agrupacion_id')->unsigned();
   $table->integer('equipo_id')->unsigned();
   $table->string('unidades_media_equipo')->nullable();
   $table->integer('unidades_fabricar')->nullable();
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

  // RUTA DEL ARCHIVO XML
  $archivo = simplexml_load_file(public_path('PartesFabrica.xml'));

  foreach ($archivo as $fabricacion) {

   $fecha_compromiso_cli = $fabricacion->note->fecha_compromiso_cli;
   $porciones = explode("-", $fecha_compromiso_cli);

   $array = ["Ene" => 1, "Feb" => 2, "Mar" => 3, "Abr" => 4, "May" => 5, "Jun" => 6, "Jul" => 7, "Ago" => 8, "Sep" => 9, "Oct" => 10, "Nov" => 11, "Dic" => 12];

   $numero_mes = array_search($porciones[1], array_keys($array));

   if ($porciones[1] == 12) {
    $porciones[1] = $numero_mes - 1;
   } else {
    $porciones[1] = $numero_mes + 1;
   }

   $fabricacion->note->fecha_compromiso_cli = $porciones[2] . "-" . $porciones[1] . "-" . $porciones[0];

   $fecha_compromiso_fab = $fabricacion->note->fecha_compromiso_fab;
   $porciones = explode("-", $fecha_compromiso_fab);

   $array = ["Ene" => 1, "Feb" => 2, "Mar" => 3, "Abr" => 4, "May" => 5, "Jun" => 6, "Jul" => 7, "Ago" => 8, "Sep" => 9, "Oct" => 10, "Nov" => 11, "Dic" => 12];

   $numero_mes = array_search($porciones[1], array_keys($array));

   if ($porciones[1] == 12) {
    $porciones[1] = $numero_mes - 1;
   } else {
    $porciones[1] = $numero_mes + 1;
   }
   $fabricacion->note->fecha_compromiso_fab = $porciones[2] . "-" . $porciones[1] . "-" . $porciones[0];

   // Formaterar date3 - fecha_compromiso_fab_1t

   $fecha_compromiso_fab_1t = $fabricacion->note->fecha_compromiso_fab_1t;
   $porciones = explode("-", $fecha_compromiso_fab_1t);
   //  echo $porciones[0] . "<br>"; // dia
   //  echo $porciones[1] . "<br>"; // mes
   //  echo $porciones[2] . "<br>"; // A??o

   $array = ["Ene" => 1, "Feb" => 2, "Mar" => 3, "Abr" => 4, "May" => 5, "Jun" => 6, "Jul" => 7, "Ago" => 8, "Sep" => 9, "Oct" => 10, "Nov" => 11, "Dic" => 12];

   $numero_mes = array_search($porciones[1], array_keys($array));

   if ($porciones[1] == 12) {
    $porciones[1] = $numero_mes - 1;
   } else {
    $porciones[1] = $numero_mes + 1;
   }

   $fabricacion->note->fecha_compromiso_fab_1t = $porciones[2] . "-" . $porciones[1] . "-" . $porciones[0];

   //  dd($fabricacion->note->fecha_compromiso_fab_1t);

   // Formaterar date 4 - fecha_compromiso_fab_2t

   $fecha_compromiso_fab_2t = $fabricacion->note->fecha_compromiso_fab_2t;
   $porciones = explode("-", $fecha_compromiso_fab_2t);
   //  echo $porciones[0] . "<br>"; // dia
   //  echo $porciones[1] . "<br>"; // mes
   //  echo $porciones[2] . "<br>"; // A??o

   //  $array = ["Enero" => 1, "Febraro" => 2, "Marzo" => 3, "Abril" => 4, "Mayo" => 5, "Junio" => 6, "Julio" => 7, "Agosto" => 8, "Septiembre" => 9, "Octubre" => 10, "Noviembre" => 11, "Diciembre" => 12];
   $array = ["Ene" => 1, "Feb" => 2, "Mar" => 3, "Abr" => 4, "May" => 5, "Jun" => 6, "Jul" => 7, "Ago" => 8, "Sep" => 9, "Oct" => 10, "Nov" => 11, "Dic" => 12];

   $numero_mes = array_search($porciones[1], array_keys($array));

   if ($porciones[1] == 12) {
    $porciones[1] = $numero_mes - 1;
   } else {
    $porciones[1] = $numero_mes + 1;
   }

   $fabricacion->note->fecha_compromiso_fab_2t = $porciones[2] . "-" . $porciones[1] . "-" . $porciones[0];

   // Formaterar date 4 - fecha_compromiso_fab_2t

   $fecha_fab = $fabricacion->note->fecha_fab;
   $porciones = explode("-", $fecha_fab);

   $array = ["Ene" => 1, "Feb" => 2, "Mar" => 3, "Abr" => 4, "May" => 5, "Jun" => 6, "Jul" => 7, "Ago" => 8, "Sep" => 9, "Oct" => 10, "Nov" => 11, "Dic" => 12];

   $numero_mes = array_search($porciones[1], array_keys($array));

   if ($porciones[1] == 12) {
    $porciones[1] = $numero_mes - 1;
   } else {
    $porciones[1] = $numero_mes + 1;
   }

   $fabricacion->note->fecha_fab = $porciones[2] . "-" . $porciones[1] . "-" . $porciones[0];

   // Formaterar date 5 - fecha_fab_1t

   $fecha_fab_1t = $fabricacion->note->fecha_fab_1t;
   $porciones = explode("-", $fecha_fab_1t);

   $array = ["Ene" => 1, "Feb" => 2, "Mar" => 3, "Abr" => 4, "May" => 5, "Jun" => 6, "Jul" => 7, "Ago" => 8, "Sep" => 9, "Oct" => 10, "Nov" => 11, "Dic" => 12];

   $numero_mes = array_search($porciones[1], array_keys($array));

   if ($porciones[1] == 12) {
    $porciones[1] = $numero_mes - 1;
   } else {
    $porciones[1] = $numero_mes + 1;
   }

   $fabricacion->note->fecha_fab_1t = $porciones[2] . "-" . $porciones[1] . "-" . $porciones[0];

   //  dd($fabricacion->note->fecha_fab_1t);

   // Formaterar date 6 - fecha_fab_2t

   $fecha_fab_2t = $fabricacion->note->fecha_fab_2t;
   $porciones = explode("-", $fecha_fab_2t);

   $array = ["Ene" => 1, "Feb" => 2, "Mar" => 3, "Abr" => 4, "May" => 5, "Jun" => 6, "Jul" => 7, "Ago" => 8, "Sep" => 9, "Oct" => 10, "Nov" => 11, "Dic" => 12];

   $numero_mes = array_search($porciones[1], array_keys($array));

   if ($porciones[1] == 12) {
    $porciones[1] = $numero_mes - 1;
   } else {
    $porciones[1] = $numero_mes + 1;
   }

   $fabricacion->note->fecha_fab_2t = $porciones[2] . "-" . $porciones[1] . "-" . $porciones[0];

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
    "#f34a22" => 'UDO 018',
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

   //  dd(round($fabricacion->note->horas_necesarias, 0, PHP_ROUND_HALF_EVEN));

   $horas_necesarias = round($fabricacion->note->horas_necesarias, 0, PHP_ROUND_HALF_EVEN);

   echo ($horas_necesarias);
   echo ($fabricacion->note->fecha_fab_2t);
   if ($horas_necesarias <= 8) {
    $fabricacion->note->fecha_fab_2t;

   } elseif ($horas_necesarias >= 8 and $horas_necesarias < 16) {
    echo "Sumale 1 dia";
    //sumo 1 d??a
    $fecha_fab_2t = date("d-m-Y", strtotime($fabricacion->note->fecha_fab_2t . "+ 1 days"));

   } elseif ($horas_necesarias >= 16 and $horas_necesarias < 24) {
    echo "Sumale 2 dia";
    $fecha_fab_2t = date("d-m-Y", strtotime($fabricacion->note->fecha_fab_2t . "+ 2 days"));

   } elseif ($horas_necesarias >= 24 and $horas_necesarias < 32) {
    echo "Sumale 3 dia";
    $fecha_fab_2t = date("d-m-Y", strtotime($fabricacion->note->fecha_fab_2t . "+ 3 days"));

   } elseif ($horas_necesarias >= 32 and $horas_necesarias < 40) {
    echo "Sumale 4 dia";

    $fecha_fab_2t = date("d-m-Y", strtotime($fabricacion->note->fecha_fab_2t . "+ 4 days"));

   } else {
    echo "no se a podido Calcular las horas";
   }

   //  dd($fecha_compromiso_fab_2t);

   $sql_consulta_agrupacion = DB::table('agrupaciones')->select('id')->where("nombre", "=", $fabricacion->note->agrupacion)->get();

   foreach ($sql_consulta_agrupacion as $agrupacion) {

   }

   $sql_consulta_equipos = DB::table('equipos')->select('id')->where("cod_equipo", "=", $fabricacion->note->cod_equipo)->get();

   foreach ($sql_consulta_equipos as $o) {

   }

   $sql_consulta_secciones = DB::table('secciones')->select('id')->where("seccion", "=", $fabricacion->note->seccion)->get();
   foreach ($sql_consulta_secciones as $seccion) {

   }

   DB::table('calendars')->insert([
    'agrupacion_id' => $agrupacion->id,
    'seccion_id' => $seccion->id,
    'equipo_id' => $o->id,
    'recurso' => $fabricacion->note->recurso,
    'unidades_media_equipo' => $fabricacion->note->unidades_media_equipo,
    'unidades_fabricar' => $fabricacion->note->unidades_fabricar,
    'unidades_brutas' => $fabricacion->note->unidades_brutas,
    'horas_necesarias' => $horas_necesarias,
    'fecha_compromiso_cli' => date('Y-m-d', strtotime($fabricacion->note->fecha_compromiso_cli)),
    'fecha_compromiso_fab' => date('Y-m-d', strtotime($fabricacion->note->fecha_compromiso_fab)),
    'fecha_compromiso_fab_1t' => date('Y-m-d', strtotime($fabricacion->note->fecha_compromiso_fab_1t)),
    'fecha_compromiso_fab_2t' => date('Y-m-d', strtotime($fabricacion->note->fecha_compromiso_fab_2t)),
    'fecha_fab' => date('Y-m-d', strtotime($fabricacion->note->fecha_fab)),
    'fecha_fab_1t' => date('Y-m-d', strtotime($fabricacion->note->fecha_fab_1t)),
    'fecha_fab_2t' => date('Y-m-d', strtotime($fecha_fab_2t)),
    'dias' => $fabricacion->note->dias,
    'dias1t' => $fabricacion->note->dias1t,
    'dias2t' => $fabricacion->note->dias2t,
    'tipo_necesidad' => $fabricacion->note->tipo_necesidad,
    'pedido' => $fabricacion->note->pedido,
    'cliente_codigo' => $fabricacion->note->cliente_codigo,
    'cliente_nombre' => $fabricacion->note->cliente_nombre,
    'cliente' => $fabricacion->note->cliente,
    'articulo_codigo' => $fabricacion->note->articulo_codigo,
    'articulo_nombre' => $fabricacion->note->articulo_nombre,
    'articulo' => $fabricacion->note->articulo,
    'articulo_marca' => $fabricacion->note->articulo_marca,
    'es_desglose_necesidad' => $fabricacion->note->es_desglose_necesidad,
    'articulo_padre' => $fabricacion->note->articulo_padre,
    'articulo_fabricar' => $fabricacion->note->articulo_fabricar,
    'establecimiento' => $fabricacion->note->establecimiento,
    'pais' => $fabricacion->note->pais,
    'gama' => $fabricacion->note->gama,
    'parte' => $fabricacion->note->parte,
    'color' => $color,
    'created_at' => $fecha,
    'updated_at' => $fecha,

   ]);

  }
  // return Redirect::to('')->with('success','La carga de los datos ha sido actualizada con exito');
  return redirect('')->with('flash', 'La carga de los datos ha sido actualizada con exito');

 }
}
