<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TahunAkademik;
use Yajra\Datatables\Datatables;

class TahunakademikController extends Controller
{
	function json(){
        return Datatables::of(TahunAkademik::all())
        ->addColumn('action', function ($row) {
            $action  = '<a href="/tahunakademik/'.$row->kode_tahun_akademik.'/edit" class="btn btn-primary btn-sm"><i class="fas fa-pencil-alt"></i></a>';
            $action .= \Form::open(['url'=>'tahunakademik/'.$row->kode_tahun_akademik,'method'=>'delete','style'=>'float:right']);
            $action .= "<button type='submit'class='btn btn-danger btn-sm'><i class='fas fa-trash-alt'></i></button>";
            $action .= \Form::close();
            return $action;
        })
        ->make(True);
        	}
    public function index()
    {
        return view('tahunakademik.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tahunakademik.create');
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
            'kode_tahun_akademik' => 'required|unique:tahun_akademik|min:2',
            'tahun_akademik' => 'required'
        ]);
        $tahunakademik = New TahunAkademik();
        $tahunakademik->create($request->all());
        return redirect('/tahunakademik')->with('status','Data Tahun Akademik Berhasil Disimpan');
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
        $data['tahunakademik'] = TahunAkademik::where('kode_tahun_akademik',$id)->first();
        return view('tahunakademik.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $kode_tahun_akademik)
    {
        $request->validate([
			'tahun_akademik' => 'required'
        ]);
        $tahunakademik = TahunAkademik::where('kode_tahun_akademik','=',$kode_tahun_akademik);
        $tahunakademik->update($request->except('_method','_token'));
        return redirect('/tahunakademik')->with('status','Data Tahun Akademik Berhasil Di Update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($kode_tahunakademik)
    {
        $tahunakademik = TahunAkademik::where('kode_tahun_akademik',$kode_tahunakademik);
        $tahunakademik->delete();
        return redirect('/tahunakademik')->with('status','Data Tahun Akademik Berhasil Dihapus');
    }
}

