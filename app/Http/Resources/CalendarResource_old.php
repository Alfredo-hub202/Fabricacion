<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CalendarResource extends JsonResource
{
 /**
  * Transform the resource into an array.
  *
  * @param  \Illuminate\Http\Request  $request
  * @return array
  */
 public function toArray($request)
 {
  dd($request);
  return $request;

//   return [
  //    'id' => $this->id,
  //    'cod_equipo' => $this->cod_equipo,
  //    //  'equipo_id' => $this->equipo,
  //    'equipo' => $this->equipo,
  //    'title' => $this->articulo_nombre,
  //    'start' => $this->fecha_compromiso_fab,
  // //    'start' => $this->fecha_fab,
  //    'end' => $this->fecha_fab_2t,
  //    'codigo_articulo' => $this->articulo_codigo,
  //    'recurso' => $this->recurso,
  //    'seccion' => $this->seccion,
  //    'agrupacion' => $this->agrupacion,
  //    'nom_equipo' => $this->equipo,
  //    'unidades_media_equipo' => $this->unidades_media_equipo,
  //    'unidades_fabricar' => $this->unidades_fabricar,
  //    'unidades_brutas' => $this->unidades_brutas,
  //    'horas_necesarias' => $this->horas_necesarias,
  //    'fecha_compromiso_cli' => $this->fecha_compromiso_cli,
  //    'fecha_compromiso_fab_1t' => $this->fecha_compromiso_fab_1t,
  //    'fecha_compromiso_fab_2t' => $this->fecha_compromiso_fab_2t,
  //    'fecha_fab' => $this->fecha_fab,
  //    'fecha_fab_1t' => $this->fecha_fab_1t,
  //    'dias' => $this->dias,
  //    'dias1t' => $this->dias1t,
  //    'dias2t' => $this->dias2t,
  //    'tipo_necesidad' => $this->tipo_necesidad,
  //    'pedido' => $this->pedido,
  //    'cliente_codigo' => $this->cliente_codigo,
  //    'cliente_nombre' => $this->cliente_nombre,
  //    'cliente' => $this->cliente,
  //    'articulo_nombre' => $this->articulo_nombre,
  //    'articulo' => $this->articulo,
  //    'articulo_marca' => $this->articulo_marca,
  //    'es_desglose_necesidad' => $this->es_desglose_necesidad,
  //    'articulo_padre' => $this->articulo_padre,
  //    'articulo_fabricar' => $this->articulo_fabricar,
  //    'establecimiento' => $this->establecimiento,
  //    'pais' => $this->pais,
  //    'gama' => $this->gama,
  //    'parte' => $this->parte,
  //    'color' => $this->color,
  //   ];
 }
}
