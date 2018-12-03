<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Master_mains extends Model
{
    protected $talble = 'master_mains';
    protected $fillable = ['master_code','master_name','master_type'];
}
