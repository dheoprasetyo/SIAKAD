<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fakultas extends Model
{
        protected $table="fakultas";
    
    	protected $fillable=['kode_fakultas','nama_fakultas'];
}
