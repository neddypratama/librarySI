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
<body style="background-color: #828282" class="">
    <div class="container-fluid">
      <div class="row" style="height: 100vh">
          <div class="col-md-4 col-sm-12 m-3 p-5 d-flex align-items-center justify-content-center"  style="background-color: #D9D9D9">
              <div class="p-4">
                <div class="p-5">
                  <div class="font-weight-bold" style="font-size: 32px;">
                      SISTEM INFORMASI MODUL TRANSAKSI SIRKULASI
                  </div>
                  <hr style="border: none; height: 1px; color: #333; background-color: #333; width: 100%;">
                  <div class="font-italic pt-2 " style="font-size: 16px;">
                      Sekarang Kamu Meminjam buku cukup menggunakan smarphone tidak ada kartu anggota
                  </div>
                </div>
              </div>
          </div>
          <div class="col-md-7 col-sm-12 d-flex align-items-center justify-content-center">
              <div >
                  <div class="pt-5 pb-5 font-weight-bold font-italic text-center" style="font-size: 45px;">SELAMAT DATANG!</div>
                  <form action="{{ route('proses_login')}}" method="post" class="mt-5">
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
                      <div class="input-group mb-5">
                          <div class="input-group-prepend">
                              <span class="input-group-text"><i class="fas fa-lock"></i></span>
                          </div>
                          <input type="password" class="form-control" placeholder="Password" name="password" id="inputPassword" value="{{ old('password') }}">
                          <button type="button" style="border: none" class="btn btn-light" id="tampilButton">
                            <span class="fas fa-eye"></span>
                        </button>
                      </div> 
                      <button class="btn btn-block font-weight-bold font-italic" style="background-color: #FFCD29; font-size: 20px;">Login</button>
                      <div>
                        <div class="pt-2 font-weight-bolder d-flex justify-content-between">
                            <a href="{{ route('register')}}" style="color: #D9D9D9;" >Register</a>
                            <a href="{{ route('lupa_password')}}" style="color: black;" >Lupa Password?</a>
                        </div> 
                      </div>
                  </form>
              </div>
          </div>
      </div>
  </div>
  
  <script>
    const passwordInput = document.getElementById('inputPassword');
    const togglePassword = document.getElementById('tampilButton');

    togglePassword.addEventListener('click', function() {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        togglePassword.innerHTML = type === 'password' ? '<span class="fas fa-eye"></span>' : '<span class="fas fa-eye-slash"></span>';
    });
</script>

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