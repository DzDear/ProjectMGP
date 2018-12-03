<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class temperature extends Model
{
  protected $table = 'temperatures';
  protected $fillable = ['date_log','time_log',
                        'Ls_log','Sc_log','temp_log','yyyymm',];
}
