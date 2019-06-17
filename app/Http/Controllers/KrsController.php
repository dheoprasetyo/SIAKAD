<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

use App\Matakuliah;

class KrsController extends Controller
{
   
    function __construct()
    {
        return $this->middleware('auth:mahasiswa');
    }

    public function listmatkulkrs(){
        return DataTables::of(Matakuliah::all())
        ->addColumn('action', function ($row) {
            $action  = '<a href="/matakuliah/'.$row->kode_mk.'/edit" class="btn btn-primary btn-sm"><i class="fas fa-pencil-alt"></i>Ambil</a>';
            return $action;
            })
        ->make(true);
    }

    function index(){
    	return view('krs.index');
    }
}
