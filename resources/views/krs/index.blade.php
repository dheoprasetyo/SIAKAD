@extends('layouts.mahasiswa')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!

                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-bordered" id="users-table">
                                <thead>
                                    <tr>
                                        <th width="70">Kode MK</th>
                                            <th>Nama Matakuliah</th>
                                            <th width="40">SKS</th>
                                            <th width="18"></th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <h6>Daftar Matkul yang dipilih</h6>
                            <hr>
                            <table class="table table-bordered">
                                <tr>
                                    <th>Kode MK</th>
                                    <th>Nama Matkul</th>
                                    <th>SKS</th>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
$(function() {
    $('#users-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '/krs/listmatkulkrs',
        columns: [
            { data: 'kode_mk', name: 'kode_mk' },
            { data: 'nama_mk', name: 'nama_mk' },
            { data: 'jml_sks', name: 'jml_sks' },
            { data: 'action', name: 'action' }
        ]
    });
});
</script>
@endpush

