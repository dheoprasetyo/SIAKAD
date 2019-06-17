<div class="form-group row">
        <label class="col-md-2 col-form-label text-md-right">Tahun Akademik</label>
        <div class="col-md-8">
            {{ Form::text('tahun_akademik',null,['class'=>'form-control','placeholder'=>'Tahun akademik'])}}
        </div>
</div>

<div class="form-group row">
        <label class="col-md-2 col-form-label text-md-right">Status</label>
        <div class="col-md-8">
            {{ Form::select('status',['y'=>'Aktif','n'=>'Tidak Aktif'],null,['class'=>'form-control'])}}
        </div>
</div>
