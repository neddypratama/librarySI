@extends('layout.template') 
 
@section('content') 
  <div class="card card-outline "> 
    <div class="card-header"> 
      <h3 class="card-title">{{ $page->title }}</h3> 
      <div class="card-tools"></div> 
    </div> 
    <div class="card-body"> 
      @empty($transaksi) 
        <div class="alert alert-danger alert-dismissible"> 
            <h5><i class="icon fas fa-ban"></i> Kesalahan!</h5> 
            Data yang Anda cari tidak ditemukan. 
        </div> 
        <a href="{{ url('transaksi') }}" class="btn btn-sm btn-default mt-2">Kembali</a> 
      @else 
        <form method="POST" action="{{ url('/transaksi/'.$transaksi->transaksi_id) }}" 
class="form-horizontal" enctype="multipart/form-data"> 
@csrf 
{!! method_field('PUT') !!}  <!-- tambahkan baris ini untuk proses edit yang butuh method PUT --> 
<div class="form-group row"> 
  <label class="col-2 control-label col-form-label">User</label> 
  <div class="col-10"> 
    <select class="form-control" id="user_id" name="user_id" required> 
      <option value="">- Pilih User -</option> 
      @foreach($user as $item) 
        <option value="{{ $item->user_id }}" 
          @if($item->user_id == $transaksi->user_id) 
          selected @endif>{{ $item->nama }}</option> 
      @endforeach 
    </select> 
    @error('user_id') 
      <small class="form-text text-danger">{{ $message }}</small> 
    @enderror 
  </div> 
</div> 
<div class="form-group row"> 
  <label class="col-2 control-label col-form-label">Buku</label> 
  <div class="col-10"> 
    <select class="form-control" id="buku_id" name="buku_id" required> 
      <option value="">- Pilih Buku -</option> 
      @foreach($buku as $item) 
        <option value="{{ $item->buku_id }}" 
          @if($item->buku_id == $transaksi->buku_id) 
          selected @endif>{{ $item->judul }}</option> 
      @endforeach 
    </select> 
    @error('buku_id') 
      <small class="form-text text-danger">{{ $message }}</small> 
    @enderror 
  </div> 
</div>
<div class="form-group row"> 
  <label class="col-2 control-label col-form-label">Kode Transaksi</label>
  <div class="col-10"> 
    <input type="text" class="form-control" id="transaksi_kode" name="transaksi_kode" value="{{ old('transaksi_kode', $transaksi->transaksi_kode) }}"> 
    @error('transaksi_kode') 
      <small class="form-text text-danger">{{ $message }}</small> 
    @enderror 
  </div> 
</div>  
<div class="form-group row"> 
  <label class="col-2 control-label col-form-label">Tanggal Peminjaman</label>
  <div class="col-10"> 
    <input type="date" class="form-control" id="tgl_peminjaman" name="tgl_peminjaman" value="{{ old('tgl_peminjaman', $transaksi->tgl_peminjaman) }}"> 
    @error('tgl_peminjaman') 
      <small class="form-text text-danger">{{ $message }}</small> 
    @enderror 
  </div> 
</div> 
<div class="form-group row"> 
  <label class="col-2 control-label col-form-label">Tanggal Pengembalian</label> 
  <div class="col-10"> 
    <input type="date" class="form-control" id="tgl_pengembalian" name="tgl_pengembalian" value="{{ old('tgl_pengembalian', $transaksi->tgl_pengembalian) }}" > 
    @error('tgl_pengembalian') 
      <small class="form-text text-danger">{{ $message }}</small> 
    @enderror 
  </div> 
</div> 
<div class="form-group row"> 
  <label class="col-2 control-label col-form-label">Jumlah Denda</label> 
  <div class="col-10"> 
    <input type="number" class="form-control" id="denda" name="denda" value="{{ old('denda', $transaksi->denda) }}" readonly> 
    @error('denda') 
      <small class="form-text text-danger">{{ $message }}</small> 
    @enderror 
  </div> 
</div> 
<div class="form-group row"> 
  <label class="col-2 control-label col-form-label"></label> 
  <div class="col-10"> 
    <button type="submit" class="btn btn-primary btn-sm">Simpan</button> 
    <a class="btn btn-sm btn-default ml-1" href="{{ url('transaksi') }}">Kembali</a> 
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