<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Dosen;

class DosenController extends Controller
{

    public function json(){
        return DataTables::of(Dosen::all())
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
            'nidn' => 'required|unique:dosens|min:10',
            'nama' => 'required|min:6',
            'email'     =>'required|unique:dosens',
            'no_hp'     =>'required'
        ]);
        $dosen = New Dosen();
        $dosen->create($request->all());
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
        $data['dosen'] = Dosen::where('nidn',$id)->first();
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
        $dosen = Dosen::where('nidn','=',$nidn);
        $dosen->update($request->except('_method','_token'));
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
        $dosen = Dosen::where('nidn',$nidn);
        $dosen->delete();
        return redirect('/dosen')->with('status','Data Dosen Berhasil Dihapus');
    }
}
