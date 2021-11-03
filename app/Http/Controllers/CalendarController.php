<?php

namespace App\Http\Controllers;

use App\Calendar;
use App\Equipo;
use App\Http\Resources\CalendarResource;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CalendarController extends Controller
{
 /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
 public function index()
 {
  // return Calendar::all();
  return CalendarResource::collection(Calendar::with('equipos')->get());

 }

 /**
  * Show the form for creating a new resource.
  *
  * @return \Illuminate\Http\Response
  */
 public function create()
 {
  //
 }

 /**
  * Store a newly created resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @return \Illuminate\Http\Response
  */
 public function store(Request $request)
 {
  $new_calendar = Calendar::create($request->all());

  return response()->json([
   'data' => new CalendarResource($new_calendar),
   'message' => '¡Nuevo evento agregado exitosamente!',
   'status' => Response::HTTP_CREATED,
  ]);
 }

 /**
  * Display the specified resource.
  *
  * @param  \App\Calendar  $calendar
  * @return \Illuminate\Http\Response
  */
 public function show(Calendar $calendar)
 {
  return response($calendar, Response::HTTP_OK);
 }

 /**
  * Show the form for editing the specified resource.
  *
  * @param  \App\Calendar  $calendar
  * @return \Illuminate\Http\Response
  */
 public function edit(Calendar $calendar)
 {
  //
 }

 /**
  * Update the specified resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @param  \App\Calendar  $calendar
  * @return \Illuminate\Http\Response
  */
 public function update(Request $request, Calendar $calendar)
 {
  $calendar->update($request->all());
  return response()->json([
   'data' => new CalendarResource($calendar),
   'message' => 'Evento actualizado con éxito!',
   'status' => Response::HTTP_ACCEPTED,
  ]);
 }

 /**
  * Remove the specified resource from storage.
  *
  * @param  \App\Calendar  $calendar
  * @return \Illuminate\Http\Response
  */
 public function destroy(Calendar $calendar)
 {
  $calendar->delete();
  return response('¡Evento eliminado con éxito!', Response::HTTP_NO_CONTENT);
 }

 // Dependencia de Select Busqueda Full Calendar
 public function getEquipo()
 {
  //
  $equipo = Equipo::all();
  $data = [];
  $data[0] = [
   'id' => 0,
   'text' => 'Seleccione',
  ];

  foreach ($equipo as $key => $value) {
   $data[$key + 1] = [
    'id' => $value->id,
    'nom_equipo' => $value->nom_equipo,
    'equipo' => $value->equipo,
    'color' => $value->color,
   ];
  }
  return response()->json($data);

 }

 public function getfabricaciones($id)
 {

 }
}
