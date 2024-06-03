@extends('layout.template') 
 
@section('content') 
  <div class="card card-outline"> 
      <div class="card-header"> 
        <h3 class="card-title">{{ $page->title }}</h3> 
        <div class="card-tools"> 
          {{-- <a class="btn btn-sm btn-primary mt-1" href="{{ url('user/create') }}">Tambah</a>  --}}
        </div> 
      </div> 
      <div class="card-body"> 
        @if (session('success'))
        <div class="alert alert-success">{{session('success')}}</div>
        @endif
        @if (session('error'))
        <div class="alert alert-danger">{{session('error')}}</div>
        @endif
        <div class="row">
          <div class="col-6">
            <label class="col-2 control-label col-form-label">Filter:</label>
            <div class="col-4">
              <select class="form-control" id="user_id" name="user_id" required>
                <option value="">- Semua -</option>
                @foreach ($user as $item)
                <option value="{{$item->user_id}}">{{$item->nama}}</option>
                @endforeach
              </select>
              <div class="mt-2 mb-3">
                <span>User</span>
              </div>
            </div>
          </div>
          <div class="col-6">
            <label class="col-2 control-label col-form-label">Filter:</label>
            <div class="col-4">
              <select class="form-control" id="buku_id" name="buku_id" required>
                <option value="">- Semua -</option>
                @foreach ($buku as $item)
                <option value="{{$item->buku_id}}">{{$item->judul}}</option>
                @endforeach
              </select>
              <div class="mt-2 mb-3">
                <span>Buku</span>
              </div>
            </div>
          </div>
        </div>
        <table class="table table-bordered table-striped table-hover table-sm" id="table_transaksi"> 
          <thead> 
            <tr><th>ID</th><th>NIM</th><th>Nama User</th><th>Judul Buku</th><th>Tanggal Peminjaman</th><th>Tanggal Pengembalian</th><th>Denda</th><th>Status</th><th>Aksi</th></tr>
          </thead> 
      </table> 
    </div> 
  </div> 
@endsection 
 
@push('css') 
@endpush 
@push('js') 
  <script> 
    $(document).ready(function() { 
      var dataTransaksi = $('#table_transaksi').DataTable({ 
        pageLength: 25,
          processing: true,
          serverSide: true,     // serverSide: true, jika ingin menggunakan server side processing 
          dom: '<"d-flex justify-content-between align-items-center"lBf>tipr',
        language: {
            buttons: {
                colvis : 'show / hide', // label button show / hide colvisRestore: "Reset Kolom" //lael untuk reset kolom ke default
            }
        },
        buttons : [
            {extend: 'colvis', postfixButtons: [ 'colvisRestore' ] },
            {
                extend:'csv' ,
                title:'Tabel Transaksi',
                exportOptions : {columns: [0,1,2,3,4,5,6,7]}
            },
            {
                extend: 'pdf', 
                title:'Tabel Transaksi',
                exportOptions : {columns: [0,1,2,3,4,5,6,7]}
            },
            {
                extend: 'excel', 
                title: 'Tabel Transaksi',
                exportOptions : {columns: [0,1,2,3,4,5,6,7]}
            },
            {
                extend:'print',
                title: 'Tabel Transaksi',
                exportOptions : {columns: [0,1,2,3,4,5,6,7]}
            },
        ],
          ajax: { 
              "url": "{{ url('transaksi/list') }}", 
              "dataType": "json", 
              "type": "POST",
              "data":function(d){
                d.user_id = $('#user_id').val();
                d.buku_id = $('#buku_id').val();
              }
          }, 
          columns: [ 
            { 
             data: "DT_RowIndex", // nomor urut dari laravel datatable addIndexColumn()            
              className: "text-center", 
              orderable: false, 
              searchable: false     
            },{ 
              data: "user.nim",                
              className: "", 
              orderable: true,    // orderable: true, jika ingin kolom ini bisa diurutkan 
              searchable: true,    // searchable: true, jika ingin kolom ini bisa dicari 
            },{ 
              data: "user.nama",                
              className: "", 
              orderable: true,    // orderable: true, jika ingin kolom ini bisa diurutkan 
              searchable: true,    // searchable: true, jika ingin kolom ini bisa dicari 
            },{ 
              data: "buku.judul",                
              className: "", 
              orderable: true,    // orderable: true, jika ingin kolom ini bisa diurutkan 
              searchable: true    // searchable: true, jika ingin kolom ini bisa dicari 
            },{ 
              data: "tgl_peminjaman",                
              className: "", 
              orderable: true,    // orderable: true, jika ingin kolom ini bisa diurutkan 
              searchable: true    // searchable: true, jika ingin kolom ini bisa dicari 
            },{ 
              data: "tgl_pengembalian",                
              className: "", 
              orderable: false,    // orderable: true, jika ingin kolom ini bisa diurutkan 
              searchable: false    // searchable: true, jika ingin kolom ini bisa dicari
            },{ 
              data: "denda",                
              className: "", 
              orderable: true,    // orderable: true, jika ingin kolom ini bisa diurutkan 
              searchable: true,    // searchable: true, jika ingin kolom ini bisa dicari 
            },{ 
              data: "status",                
              className: "", 
              orderable: false,    // orderable: true, jika ingin kolom ini bisa diurutkan 
              searchable: false    // searchable: true, jika ingin kolom ini bisa dicari 
            },{ 
              data: "aksi",                
              className: "", 
              orderable: false,    // orderable: true, jika ingin kolom ini bisa diurutkan 
              searchable: false    // searchable: true, jika ingin kolom ini bisa dicari 
            },
          ],
      }); 
      $('#user_id').on('change', function(){
        dataTransaksi.ajax.reload();
      });
      $('#buku_id').on('change', function(){
        dataTransaksi.ajax.reload();
      });
    }); 
  </script> 
@endpush 