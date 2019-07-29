<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Hash;
use App\Dosen;
use Auth;

class DosenController extends Controller
{

    public function json(){
        return DataTables::of(dosen::all())
        ->addColumn('action', function ($row) {
            $action  = '<a href="/dosen/'.$row->nidn.'/edit" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>';
            $action .= \Form::open(['url'=>'dosen/'.$row->nidn,'method'=>'delete','style'=>'float:right']);
            $action .= "<button type='submit'class='btn btn-danger btn-sm '><i class='fas fa-trash-alt'></i></button>";
            $action .= \Form::close();
            return $action;
            })
        ->make(true);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dosen.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dosen.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nidn' => 'required|unique:dosen|min:10',
            'nama' => 'required|min:6',
            'email'     =>'required|unique:dosen',
            'no_hp'     =>'required'
        ]);
        $dosen = New dosen();
        $dosen->nidn        = $request->nidn;
        $dosen->kode_dosen  = $request->kode_dosen;
        $dosen->nama        = $request->nama;
        $dosen->no_hp       = $request->no_hp;
        $dosen->email       = $request->email;
        // $dosen->kode_fakultas  = $request->kode_fakultas;
        $dosen->password    = Hash::make($request->password);
        $dosen->save();
        return redirect('/dosen')->with('status','Data Dosen Berhasil Disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['dosen'] = dosen::where('nidn',$id)->first();
        return view('dosen.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $nidn)
    {
        $request->validate([
            'nama' => 'required|min:6',
            'email'     =>'required',
            'no_hp'     =>'required'
        ]);
        $dosen = dosen::where('nidn',$nidn)->first();
        $dosen->nidn        = $request->nidn;
        $dosen->kode_dosen  = $request->kode_dosen;
        $dosen->nama        = $request->nama;
        $dosen->no_hp       = $request->no_hp;
        // $dosen->kode_fakultas  = $request->kode_fakultas;
        $dosen->email       = $request->email;
        if($request->password!='')
        {
            $dosen->password    = Hash::make($request->password);
        }
        $dosen->update();
        return redirect('/dosen')->with('status','Data Dosen Berhasil Di Update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($nidn)
    {
        $dosen = dosen::where('nidn',$nidn);
        $dosen->delete();
        return redirect('/dosen')->with('status','Data Dosen Berhasil Dihapus');
    }

    function jadwal_mengajar(){
        return view('dosen.jadwal_mengajar');
    }

    function jadwal_mengajar_json(){
        $jadwal = \DB::table('jadwal_kuliah')
                ->join('ruangan','ruangan.kode_ruangan','=','jadwal_kuliah.kode_ruangan')
                ->join('matakuliah','matakuliah.kode_mk','=','jadwal_kuliah.kode_mk')
                ->join('jam_kuliah','jam_kuliah.id','=','jadwal_kuliah.jam')
                ->join('jurusan','jurusan.kode_jurusan','=','jadwal_kuliah.kode_jurusan')
                ->where('jadwal_kuliah.kode_dosen',Auth::guard('dosen')->user()->kode_dosen);

       return Datatables::of($jadwal)
        ->addColumn('action', function ($row) {
            $action  = '<a href="/nilai/'.$row->id.'" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i>Nilai</a>';
            // $action = "";
            return $action;
        })
        ->make(true);

    }
}
