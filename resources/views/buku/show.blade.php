@extends('layout.template') 
 
@section('content') 
  <div class="card card-outline card-primary"> 
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
        @else 
            <table class="table table-bordered table-striped table-hover table-sm"> 
                <tr> 
                    <th>ID</th> 
                    <td>{{ $buku->buku_id }}</td> 
                </tr> 
                <tr> 
                    <th>Kode Buku</th> 
                    <td>{{ $buku->buku_kode }}</td> 
                </tr> 
                <tr> 
                    <th>Judul Buku</th> 
                    <td>{{ $buku->judul }}</td> 
                </tr>
                <tr> 
                    <th>Pengarang Buku</th> 
                    <td>{{ $buku->pengarang }}</td> 
                </tr>
                <tr> 
                    <th>Penerbit Buku</th> 
                    <td>{{ $buku->penerbit }}</td> 
                </tr>
            </table> 
        @endempty 
        <a href="{{ url('buku') }}" class="btn btn-sm btn-default mt-2">Kembali</a> 
    </div> 
  </div> 
@endsection 
 
@push('css') 
@endpush 
 
@push('js') 
@endpush 