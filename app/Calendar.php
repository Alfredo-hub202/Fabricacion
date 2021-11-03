<?php

namespace App;

use App\Agrupacion;
use App\Equipo;
use App\Seccion;
use Illuminate\Database\Eloquent\Model;

class Calendar extends Model
{

 protected $table = 'calendars';

 protected $guarded = ['array'];

 public function Seccion()
 {
//   return $this->belongsTo('agrupaciones');
  return $this->belongsTo(Seccion::class, 'id');

 }

 public function equipos()
 {
//   return $this->belongsTo('agrupaciones');
  return $this->belongsTo(Equipo::class, 'id');

 }

 public function Agrupacion()
 {
//   return $this->belongsTo('agrupaciones');
  return $this->belongsTo(Agrupacion::class, 'id');

 }
}
