<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Dosen extends Authenticatable
{
    protected $table="dosen";
    protected $fillable=['nidn','nama','email','no_hp'];

    
    protected $primaryKey = "kode_dosen";

    public $incrementing = false;

}
