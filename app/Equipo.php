<?php

namespace App;

use App\Calendar;
use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{
 //
 protected $table = 'equipos';

 protected $guarded = [];

 public function Fabricacion()
 {
  return $this->hasMany(Calendar::class, 'equipo_id');

 }

}
