@extends('layout.template') 
 
@section('content') 
  <div class="card card-outline "> 
    <div class="card-header"> 
      <h3 class="card-title">{{ $page->title }}</h3> 
      <div class="card-tools"></div> 
    </div> 
    <div class="card-body"> 
      @empty($buku) 
        <div class="alert alert-danger alert-dismissible"> 
            <h5><i class="icon fas fa-ban"></i> Kesalahan!</h5> 
            Data yang Anda cari tidak ditemukan. 
        </div> 
        <a href="{{ url('buku') }}" class="btn btn-sm btn-default mt-2">Kembali</a> 
      @else 
        <form method="POST" action="{{ url('/buku/'.$buku->buku_id) }}" 
class="form-horizontal"> 
@csrf 
{!! method_field('PUT') !!}  <!-- tambahkan baris ini untuk proses edit yang butuh method PUT -->  
<div class="form-group row"> 
  <label class="col-2 control-label col-form-label">Kode Buku</label>
  <div class="col-10"> 
    <input type="text" class="form-control" id="buku_kode" name="buku_kode" value="{{ old('buku_kode', $buku->buku_kode) }}"> 
    @error('buku_kode') 
      <small class="form-text text-danger">{{ $message }}</small> 
    @enderror 
  </div> 
</div> 
<div class="form-group row"> 
  <label class="col-2 control-label col-form-label">Judul</label> 
  <div class="col-10"> 
    <input type="text" class="form-control" id="judul" name="judul" value="{{ old('judul', $buku->judul) }}" required> 
    @error('judul') 
      <small class="form-text text-danger">{{ $message }}</small> 
    @enderror 
  </div> 
</div> 
<div class="form-group row"> 
  <label class="col-2 control-label col-form-label">Pengarang</label> 
  <div class="col-10"> 
    <input type="text" class="form-control" id="pengarang" name="pengarang" value="{{ old('pengarang', $buku->pengarang) }}" required> 
    @error('pengarang') 
      <small class="form-text text-danger">{{ $message }}</small> 
    @enderror 
  </div> 
</div> 
<div class="form-group row"> 
  <label class="col-2 control-label col-form-label">Penerbit</label> 
  <div class="col-10"> 
    <input type="text" class="form-control" id="penerbit" name="penerbit" value="{{ old('penerbit', $buku->penerbit) }}" required> 
    @error('penerbit') 
      <small class="form-text text-danger">{{ $message }}</small> 
    @enderror 
  </div> 
</div> 
<div class="form-group row"> 
  <label class="col-1 control-label col-form-label"></label> 
  <div class="col-11"> 
    <button type="submit" class="btn btn-primary btn-sm">Simpan</button> 
    <a class="btn btn-sm btn-default ml-1" href="{{ url('buku') }}">Kembali</a> 
  </div> 
</div> 
</form> 
@endempty 
</div> 
</div> 
@endsection 

@push('css') 
@endpush 
@push('js') 
@endpush 