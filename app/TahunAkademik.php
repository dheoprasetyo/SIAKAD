<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TahunAkademik extends Model
{
            protected $table="tahun_akademik";
    protected $fillable=['kode_tahun_akademik','tahun_akademik', 'status'];

    function getStatusAttribute($value){
    	return $value=='y'?'Aktif':'Tidak Aktif';
    }
}
