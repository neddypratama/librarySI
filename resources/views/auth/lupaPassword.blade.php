<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ config('app.name', 'PWL Laravel Starter Code') }}</title>

  <meta name="csrf-token" content="{{ csrf_token() }}"><!-- Untuk mengirimkan token Laravel CSRF pada setiap request ajax -->

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('templete/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('templete/dist/css/adminlte.min.css') }}">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('templete/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('templete/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('templete/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

  @stack('css') <!-- Digunakan untuk memanggil custom css dari perintah push('css') pada masing-masing view -->
</head>
<body style="background-color: #828282" class="hold-transition login-page">
  <div class="login-box " style="background-color: #D9D9D9; border-radius: 50px">
    <div class="card card-outline" style="background-color: #D9D9D9;">
      <div class="mt-5 px-4 text-center" >
        <div class="font-weight-bold" style="font-size: 40px">Lupa Password</div>
      </div>
      <div class="card-body mt-5" style="background-color: #D9D9D9;">
        <form action="{{ route('proses_lupa')}}" method="get" class="mt-5">
          @if (Session::has('success'))
              <div class="alert alert-success" role="alert">
                  {{ Session::get('success') }}
              </div>
          @endif
          @if (Session::has('error'))
              <div class="alert alert-danger" role="alert">
              {{ Session::get('error') }}
              </div>
          @endif
          @csrf
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
              </div>
              <input type="text" class="form-control" placeholder="NIM" name="nim" value="{{ old('nim') }}" >
            </div>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-user"></i></span>
              </div>
              <input type="text" class="form-control" placeholder="Nama" name="nama" value="{{ old('nama') }}" >
            </div>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-calendar-day"></i></span>
              </div>
              <input type="date" class="form-control" placeholder="Tanggal Lahir" name="tgl_lahir" value="{{ old('tgl_lahir') }}" >
          </div> 
            <button class="btn btn-block font-weight-bold font-italic" style="background-color: #828282; font-size: 20px;">Proses</button>
            <div>
              <div class="pt-4 font-weight-bolder">
                  <a href="{{ route('login')}}" class="btn btn-light btn-block" style="color: black;" >Kembali</a>
              </div> 
            </div>
        </form>
    </div>
  </div>


<!-- jQuery -->
<script src="{{ asset('templete/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('templete/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- DataTables & Plugins -->
<script src="{{ asset('templete/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('templete/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('templete/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{ asset('templete/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{ asset('templete/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{ asset('templete/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{ asset('templete/plugins/jszip/jszip.min.js')}}"></script>
<script src="{{ asset('templete/plugins/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{ asset('templete/plugins/pdfmake/vfs_fonts.js')}}"></script>
<script src="{{ asset('templete/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{ asset('templete/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{ asset('templete/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('templete/dist/js/adminlte.min.js')}}"></script>
<!-- Ajax -->
<script>
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
</script>
@stack('js')
</body>
</html>    