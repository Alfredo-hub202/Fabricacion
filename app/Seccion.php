<?php

namespace App;

use App\Calendar;
use App\Agrupacion;

use Illuminate\Database\Eloquent\Model;

class Seccion extends Model
{
 protected $table = 'secciones';

 protected $guarded = [];

 public function Fabricacion()
 {
  return $this->hasMany(Calendar::class, 'seccion_id');
 }

 public function Agrupacion()
 {
  return $this->hasMany(Agrupacion::class, 'agrupacion_id');
 }

}
