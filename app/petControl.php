<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class petControl extends Model
{
  protected $table = 'petControls';
  protected $fillable = ['date','name','file_name'];
}
