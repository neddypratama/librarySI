@extends('layout.template') 
 
@section('content') 
  <div class="card card-outline "> 
      <div class="card-header"> 
        <h3 class="card-title">{{ $page->title }}</h3> 
        <div class="card-tools"> 
          <a class="btn btn-sm mt-1" href="{{ url('buku/create') }}">Tambah</a> 
        </div> 
      </div> 
      <div class="card-body"> 
        @if (session('success'))
        <div class="alert alert-success">{{session('success')}}</div>
        @endif
        @if (session('error'))
        <div class="alert alert-danger">{{session('error')}}</div>
        @endif
        <table class="table table-bordered table-striped table-hover table-sm" id="table_buku"> 
          <thead> 
            <tr><th>ID</th><th>Kode Buku</th><th>Judul</th><th>Pengarang</th><th>Penerbit</th><th>Aksi</th></tr> 
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
      var dataUser = $('#table_buku').DataTable({ 
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
                title:'Tabel buku',
                exportOptions : {columns: [0,1,2,3,4]}
            },
            {
                extend: 'pdf', 
                title:'Tabel buku',
                exportOptions : {columns: [0,1,2,3,4]}
            },
            {
                extend: 'excel', 
                title: 'Tabel buku',
                exportOptions : {columns: [0,1,2,3,4]}
            },
            {
                extend:'print',
                title: 'Tabel buku',
                exportOptions : {columns: [0,1,2,3,4]}
            },
        ],
          ajax: { 
              "url": "{{ url('buku/list') }}", 
              "dataType": "json", 
              "type": "POST",
              "data":function(d){
                d.level_id = $('#buku_id').val();
              }
          }, 
          columns: [ 
            { 
             data: "DT_RowIndex", // nomor urut dari laravel datatable addIndexColumn()            
              className: "text-center", 
              orderable: false, 
              searchable: false     
            },{ 
              data: "buku_kode",                
              className: "", 
              orderable: true,    // orderable: true, jika ingin kolom ini bisa diurutkan 
              searchable: true,    // searchable: true, jika ingin kolom ini bisa dicari 
            },{ 
              data: "judul",                
              className: "", 
              orderable: true,    // orderable: true, jika ingin kolom ini bisa diurutkan 
              searchable: true    // searchable: true, jika ingin kolom ini bisa dicari 
            },{ 
              data: "pengarang",                
              className: "", 
              orderable: true,    // orderable: true, jika ingin kolom ini bisa diurutkan 
              searchable: true    // searchable: true, jika ingin kolom ini bisa dicari 
            },{ 
              data: "penerbit",                
              className: "", 
              orderable: false,    // orderable: true, jika ingin kolom ini bisa diurutkan 
              searchable: false    // searchable: true, jika ingin kolom ini bisa dicari
            },{ 
              data: "aksi",                
              className: "", 
              orderable: false,    // orderable: true, jika ingin kolom ini bisa diurutkan 
              searchable: false    // searchable: true, jika ingin kolom ini bisa dicari 
            } 
          ] 
      });
    }); 
  </script> 
@endpush 