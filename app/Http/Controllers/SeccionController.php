<?php

namespace App\Http\Controllers;

use App\Http\Resources\SeccionResource;
use App\Seccion;
use Symfony\Component\HttpFoundation\Response;

class SeccionController extends Controller
{
 /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
 public function index()
 {

  $classes = Seccion::all();

  return SeccionResource::collection($classes);

 }

}
