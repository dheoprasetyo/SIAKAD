<div class="form-group row">
        <label class="col-md-2 col-form-label text-md-right">Nama Dosen</label>
        <div class="col-md-8">
            {{ Form::text('nama',null,['class'=>'form-control','placeholder'=>'Nama Dosen'])}}
        </div>
</div>

<div class="form-group row">
        <label class="col-md-2 col-form-label text-md-right">No HP</label>
        <div class="col-md-4">
            {{ Form::text('no_hp',null,['class'=>'form-control','placeholder'=>'No Hp'])}}
        </div>
    </div>

    
<div class="form-group row">
        <label class="col-md-2 col-form-label text-md-right">Email</label>
        <div class="col-md-4">
            {{ Form::email('email',null,['class'=>'form-control','placeholder'=>'Email'])}}
        </div>
</div>


