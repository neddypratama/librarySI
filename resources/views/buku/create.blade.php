@extends('layout.template') 
 
@section('content') 
  <div class="card card-outline card-primary"> 
    <div class="card-header"> 
      <h3 class="card-title">{{ $page->title }}</h3> 
      <div class="card-tools"></div> 
    </div> 
    <div class="card-body"> 
      <form method="POST" action="{{ url('buku') }}" class="form-horizontal"> 
        @csrf
        <div class="form-group row"> 
          <label class="col-2 control-label col-form-label">Kode Buku</label> 
          <div class="col-10"> 
            <input type="text" class="form-control" id="buku_kode" name="buku_kode" value="{{ old('buku_kode') }}" required> 
            @error('buku_kode') 
              <small class="form-text text-danger">{{ $message }}</small> 
            @enderror 
          </div> 
        </div> 
        <div class="form-group row"> 
          <label class="col-2 control-label col-form-label">Judul</label> 
          <div class="col-10"> 
            <input type="text" class="form-control" id="judul" name="judul" value="{{ old('judul') }}" required> 
            @error('judul') 
              <small class="form-text text-danger">{{ $message }}</small> 
            @enderror 
          </div> 
        </div> 
        <div class="form-group row"> 
          <label class="col-2 control-label col-form-label">Pengarang</label> 
          <div class="col-10"> 
            <input type="text" class="form-control" id="pengarang" name="pengarang" value="{{ old('pengarang') }}" required> 
            @error('pengarang') 
              <small class="form-text text-danger">{{ $message }}</small> 
            @enderror 
          </div> 
        </div> 
        <div class="form-group row"> 
          <label class="col-2 control-label col-form-label">Penerbit</label> 
          <div class="col-10"> 
            <input type="text" class="form-control" id="penerbit" name="penerbit" required> 
            @error('penerbit') 
              <small class="form-text text-danger">{{ $message }}</small> 
            @enderror 
          </div> 
        </div> 
        <div class="form-group row"> 
          <label class="col-2 control-label col-form-label"></label> 
          <div class="col-10"> 
            <button type="submit" class="btn btn-primary btn-sm">Simpan</button> 
            <a class="btn btn-sm btn-default ml-1" href="{{ url('buku') }}">Kembali</a> 
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