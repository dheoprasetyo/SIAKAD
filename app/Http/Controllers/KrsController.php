<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

use App\Matakuliah;
use App\Krs;
use Auth;

class KrsController extends Controller
{
   
    function __construct()
    {
        return $this->middleware('auth:mahasiswa');
    }

    public function listmatkulkrs(){
        return DataTables::of(Matakuliah::all())
        ->addColumn('action', function ($row) {
            $action = '<button onClick="tambah_krs(\''.$row->kode_mk.'\')">Pilih</button>';
            // $action  = '<a href="/matakuliah/'.$row->kode_mk.'/edit" class="btn btn-primary btn-sm"><i class="fas fa-pencil-alt"></i>Ambil</a>';
            return $action;
            })
        ->make(true);
    }

    function index(){
    	return view('krs.index');
    }

    function tambahKrs(Request $request){
        $tahun_akademik = \DB::table('tahun_akademik')->where('status','y')->first();

        $krs = new Krs;
        $krs->kode_mk   = $request->kode_mk;
        $krs->npm       = Auth::guard('mahasiswa')->user()->npm;
        $krs->kode_tahun_akademik = $tahun_akademik->kode_tahun_akademik;
        $krs->save();
    }

    function tampilKrs(){
        $result = '<table class="table table-bordered">
                <tr><th>Kode MK</th><th>Nama Matakuliah</th><th>SKS</th><tr>';
        
        $krs = \DB::table('krs')
                ->join('matakuliah','krs.kode_mk','=','matakuliah.kode_mk')
                ->where('npm',Auth::guard('mahasiswa')->user()->npm)
                ->get();
        foreach($krs as $row)
        {
            $result .= '<tr>
                        <td>'.$row->kode_mk.'</td>
                        <td>'.$row->nama_mk.'</td>
                        <td>'.$row->jml_sks.'</td>
                        </tr>'; 
        }
        
        // $result .='<tr><td colspan="4"><a class="btn btn-success" href="/krs/selesai"><i class="fas fa-cart-plus"></i> Saya Selesai Mengisi KRS</a></td></tr>';
        $result .='</table>';
        return $result;
    }
}
