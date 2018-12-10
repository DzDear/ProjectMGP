<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Listcapa extends Model
{
  protected $table = 'Listcapas';
  protected $fillable = ['date','capa_name','file_name','capa_type'];
}
