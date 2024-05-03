@extends('layout.template') 
 
@section('content') 
  <div class="card card-outline card-primary"> 
      <div class="card-header"> 
        <h3 class="card-title">{{ $page->title }}</h3> 
      </div> 
      <div class="card-body"> 
        <div class="table-responsive">
          <table class="table table-bordered table-striped table-hover table-sm" id="table_denda"> 
            <thead> 
              <tr>
                <th>ID</th><th>Judul Buku</th><th>Pengarang Buku</th><th>Penerbit Buku</th><th>Tanggal Kembali</th><th>Jumlah Denda</th>
              </tr> 
            </thead> 
          </table> 
        </div>
    </div> 
  </div> 
@endsection 
 
@push('css') 
@endpush 
@push('js') 
  <script> 
    $(document).ready(function() { 
      var dataLevel = $('#table_denda').DataTable({ 
          pageLength: 25,
          processing: true,
          serverSide: true,     // serverSide: true, jika ingin menggunakan server side processing 
          ajax: { 
              "url": "{{ url('action/listDenda') }}", 
              "dataType": "json", 
              "type": "POST",
              "data":function(d){
                d.transaksi_id = $('#transaksi_id').val();
              }
          }, 
          columns: [ 
            { 
             data: "DT_RowIndex", // nomor urut dari laravel datatable addIndexColumn()            
              className: "text-center", 
              orderable: false, 
              searchable: false     
            },{ 
              data: "buku.judul",                
              className: "", 
              orderable: true,    // orderable: true, jika ingin kolom ini bisa diurutkan 
              searchable: true    // searchable: true, jika ingin kolom ini bisa dicari 
            },{ 
              data: "buku.pengarang",                
              className: "", 
              orderable: true,    // orderable: true, jika ingin kolom ini bisa diurutkan 
              searchable: true    // searchable: true, jika ingin kolom ini bisa dicari 
            },{ 
              data: "buku.penerbit",                
              className: "", 
              orderable: true,    // orderable: true, jika ingin kolom ini bisa diurutkan 
              searchable: true    // searchable: true, jika ingin kolom ini bisa dicari 
            },{ 
              data: "tgl_pengembalian",                
              className: "", 
              orderable: true,    // orderable: true, jika ingin kolom ini bisa diurutkan 
              searchable: true    // searchable: true, jika ingin kolom ini bisa dicari 
            },{ 
              data: "denda",                
              className: "", 
              orderable: true,    // orderable: true, jika ingin kolom ini bisa diurutkan 
              searchable: true    // searchable: true, jika ingin kolom ini bisa dicari 
            },
          ],
      }); 
      $('#transaksi_id').on('change', function(){
        dataLevel.ajax.reload();
      });
    }); 
  </script> 
@endpush