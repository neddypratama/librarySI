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
<body style="background-color: #828282" class="login-page">
  <div class="login-box rounded" style="background-color: #D9D9D9;">
    <div class="card card-outline" style="background-color: #D9D9D9;">
      <div class="pt-1 px-4" >
        <div class="font-weight-bold" style="font-size: 45px">BUAT AKUN BARU!</div>
      </div>
      <div class="card-body mt-3" style="background-color: #D9D9D9;">
        <form action="../../index3.html" method="post">
            <div class="input-group mb-3">
                <div class="input-group-text">
                    <span class="fas fa-user"></span>
                </div>
                <input type="text" class="form-control" placeholder="Nama">
            </div>
            <div class="input-group mb-3">
                <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
                </div>
                <input type="text" class="form-control" placeholder="NIM">
            </div>
            <div class="input-group mb-3">
                <div class="input-group-text">
                    <span class="fas fa-calendar-day"></span>
                </div>
                <input type="date" class="form-control" placeholder="Tanggal Lahir">
            </div>
            <div class="input-group mb-3">
                <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                </div>
                <input type="password" class="form-control" placeholder="Password">
            </div>
            <div class="input-group mb-3">
                <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                </div>
                <input type="password" class="form-control" placeholder="Confirm Password">
            </div>
            <button class="btn font-weight-bold btn-block mt-3 mb-3" style="height: 50px; background-color: #828282; font-size: 20px">REGISTER</button>
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