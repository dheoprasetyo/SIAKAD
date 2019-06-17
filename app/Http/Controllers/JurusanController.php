<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Jurusan;
use App\Fakultas;

class JurusanController extends Controller
{

    public function json(){
        $jurusan = \DB::table('jurusan')
                    ->join('fakultas','jurusan.kode_fakultas','=','fakultas.kode_fakultas')
                    ->get();

        return Datatables::of($jurusan)
        ->addColumn('action', function ($row) {
            $action  = '<a href="/jurusan/'.$row->kode_jurusan.'/edit" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>';
            $action .= \Form::open(['url'=>'jurusan/'.$row->kode_jurusan,'method'=>'delete','style'=>'float:right']);
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
        return view('jurusan.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	$data['fakultas'] = Fakultas::pluck('nama_fakultas','kode_fakultas');
        return view('jurusan.create',$data);
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
            'kode_jurusan' => 'required|unique:jurusan|min:2',
            'nama_jurusan' => 'required|min:6'
        ]);
        $jurusan = New Jurusan();
        $jurusan->create($request->all());
        return redirect('/jurusan')->with('status','Data Jurusan Berhasil Disimpan');
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
    	$data['fakultas'] = Fakultas::pluck('nama_fakultas','kode_fakultas');
        $data['jurusan'] = Jurusan::where('kode_jurusan',$id)->first();
        return view('jurusan.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $kode_jurusan)
    {
        $request->validate([
			'nama_jurusan' => 'required|min:6'
        ]);
        $jurusan = Jurusan::where('kode_jurusan','=',$kode_jurusan);
        $jurusan->update($request->except('_method','_token'));
        return redirect('/jurusan')->with('status','Data Jurusan Berhasil Di Update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($kode_jurusan)
    {
        $jurusan = Jurusan::where('kode_jurusan',$kode_jurusan);
        $jurusan->delete();
        return redirect('/jurusan')->with('status','Data Jurusan Berhasil Dihapus');
    }
}
