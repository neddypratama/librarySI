@extends('layout.template') 
 
@section('content') 
  <div class="card card-outline "> 
    <div class="card-header"> 
      <h3 class="card-title">{{ $page->title }}</h3> 
      <div class="card-tools"></div> 
    </div> 
    <div class="card-body"> 
      <form method="POST" action="{{ url('user') }}" class="form-horizontal" enctype="multipart/form-data"> 
        @csrf 
        <div class="form-group row"> 
          <label class="col-2 control-label col-form-label">Level</label> 
          <div class="col-10"> 
            <select class="form-control" id="level_id" name="level_id" required> 
              <option value="">- Pilih Level -</option> 
              @foreach($level as $item) 
                <option value="{{ $item->level_id }}">{{ $item->level_nama }}</option> 
              @endforeach 
            </select> 
            @error('level_id')
              <small class="form-text text-danger">{{ $message }}</small> 
            @enderror 
          </div> 
        </div> 
        <div class="form-group row"> 
          <label class="col-2 control-label col-form-label">NIM</label> 
          <div class="col-10"> 
            <input type="text" class="form-control" id="nim" name="nim" value="{{ old('nim') }}" required> 
            @error('nim') 
              <small class="form-text text-danger">{{ $message }}</small> 
            @enderror 
          </div> 
        </div> 
        <div class="form-group row"> 
          <label class="col-2 control-label col-form-label">nama</label> 
          <div class="col-10"> 
            <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama') }}" required> 
            @error('nama') 
              <small class="form-text text-danger">{{ $message }}</small> 
            @enderror 
          </div> 
        </div> 
        <div class="form-group row"> 
          <label class="col-2 control-label col-form-label">Tanggal Lahir</label> 
          <div class="col-10"> 
            <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir" value="{{ old('tgl_lahir') }}" required> 
            @error('tgl_lahir') 
              <small class="form-text text-danger">{{ $message }}</small> 
            @enderror 
          </div> 
        </div> 
        <div class="form-group row"> 
          <label class="col-2 control-label col-form-label">Password</label> 
          <div class="col-10"> 
            <input type="password" class="form-control" id="password" name="password" required> 
            @error('password') 
              <small class="form-text text-danger">{{ $message }}</small> 
            @enderror 
          </div> 
        </div> 
        <div class="form-group row"> 
          <label class="col-1 control-label col-form-label"></label> 
          <div class="col-11"> 
            <button type="submit" class="btn btn-primary btn-sm">Simpan</button> 
            <a class="btn btn-sm btn-default ml-1" href="{{ url('user') }}">Kembali</a> 
          </div> 
        </div> 
     </form> 
    </div> 
  </div> 
@endsection 
@push('css') 
@endpush 
@push('js') 
@endpush 