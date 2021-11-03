<?php

namespace App\Http\Controllers;

use App\Equipo;
use App\Http\Resources\EquiposResource;
use Symfony\Component\HttpFoundation\Response;

class EquipoController extends Controller
{
 /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
 public function index()
 {

//   dd("hoola");
  $agrupaciones_id = request('agrupaciones_id');

  $equipos = Equipo::where('agrupaciones_id', $agrupaciones_id)->get();
//   dd($equipos);
  return EquiposResource::collection($equipos);

 }

}
