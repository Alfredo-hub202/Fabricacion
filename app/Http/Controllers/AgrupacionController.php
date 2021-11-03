<?php

namespace App\Http\Controllers;

use App\Agrupacion;
use App\Http\Resources\AgrupacionesResource;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AgrupacionController extends Controller
{
 /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
 public function index()
 {

  $seccion_id = request('seccion_id');
  $sections = Agrupacion::where('seccion_id', $seccion_id)->get();

  return AgrupacionesResource::collection($sections);

 }

}
