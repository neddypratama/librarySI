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
        @else 
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover table-sm"> 
                    <tr> 
                        <th>ID</th> 
                        <td>{{ $transaksi->transaksi_id }}</td> 
                    </tr> 
                    <tr> 
                        <th>Kode transaksi</th> 
                        <td>{{ $transaksi->transaksi_kode }}</td> 
                    </tr> 
                    <tr> 
                        <th>NIM</th> 
                        <td>{{ $transaksi->user->nim }}</td> 
                    </tr>
                    <tr> 
                        <th>Nama User</th> 
                        <td>{{ $transaksi->user->nama }}</td> 
                    </tr>
                    <tr> 
                        <th>Judul Buku</th> 
                        <td>{{ $transaksi->buku->judul }}</td> 
                    </tr>
                    <tr> 
                        <th>Pengarang Buku</th> 
                        <td>{{ $transaksi->buku->pengarang }}</td> 
                    </tr>
                    <tr> 
                        <th>Penerbit Buku</th> 
                        <td>{{ $transaksi->buku->penerbit }}</td> 
                    </tr>
                    <tr> 
                        <th>Tanggal Pinjam</th> 
                        <td>{{ $transaksi->tgl_peminjaman }}</td> 
                    </tr>
                    <tr> 
                        <th>Tanggal Kembali</th> 
                        <td>{{ $transaksi->tgl_pengembalian }}</td> 
                    </tr>
                    <tr> 
                        <th>Jumlah Denda</th> 
                        <td>{{ $transaksi->denda }}</td> 
                    </tr>
                </table> 
            </div>
        @endempty 
        <a href="{{ url('transaksi') }}" class="btn btn-sm btn-default mt-2">Kembali</a> 
    </div> 
  </div> 
@endsection 
 
@push('css') 
@endpush 
 
@push('js') 
@endpush 