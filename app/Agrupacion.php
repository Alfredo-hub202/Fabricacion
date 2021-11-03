<?php

namespace App;

use App\Calendar;
use Illuminate\Database\Eloquent\Model;

class Agrupacion extends Model
{
 protected $table = 'agrupaciones';

 protected $guarded = [];

 public function Fabricacion()
 {
  return $this->hasMany(Calendar::class, 'agrupacion_id');

 }

//  public function Seccion()
 //  {
 //   return $this->hasMany(Seccion::class, 'id');

//  }

}
