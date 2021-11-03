<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CargaXml extends Model
{
 protected $guarded = ['array'];
 // 'calendars' => 'array',

 public function agrupaciones()
 {
  return $this->belongsTo('agrupaciones');

 }
}
