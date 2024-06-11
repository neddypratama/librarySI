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
        @if (Session::has('success'))
            <div class="alert alert-success" role="alert">
                {{ Session::get('success') }}
            </div>
        @endif
        @if (Session::has('sama'))
            <div class="alert alert-danger" role="alert">
                {{ Session::get('sama') }}
            </div>
        @endif
        <form action="{{ route('proses_register')}}" method="post">
            @csrf
            <div class="input-group mb-3">
                <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
                </div>
                <input type="text" class="form-control" placeholder="NIM" name="nim" @if($errors->has('nim')) pattern="\d*" inputmode="numeric" value="" @else value="{{ old('nim') }}" @endif>
            </div>
            @error('nim')
                <small class="form-text text-danger">{{ $message }}</small> 
            @enderror 
            <div class="input-group mb-3">
                <div class="input-group-text">
                    <span class="fas fa-user"></span>
                </div>
                <input type="text" class="form-control" placeholder="Nama" name="nama" @if($errors->has('nama')) pattern="[A-Za-z\s]+" value="" @else value="{{ old('nama') }}" @endif>
            </div>
            @error('nama')
                <small class="form-text text-danger">{{ $message }}</small> 
            @enderror 
            <div class="input-group mb-3">
                <div class="input-group-text">
                    <span class="fas fa-calendar-day"></span>
                </div>
                <input type="date" class="form-control" placeholder="Tanggal Lahir" name="tgl_lahir" @if($errors->has('tgl_lahir')) value="" @else value="{{ old('tgl_lahir') }}" @endif>
            </div>
            @error('tgl_lahir')
                <small class="form-text text-danger">{{ $message }}</small> 
            @enderror 
            <div class="input-group mb-3">
                <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                </div>
                <input type="password" class="form-control" placeholder="Password" name="password" id="inputPassword" @if($errors->has('password')) value="" @else value="{{ old('password') }}" @endif>
                <button type="button" style="border: none" class="btn btn-light" id="tampilButton">
                        <span class="fas fa-eye"></span>
                </button>
            </div>
            @error('password')
                <small class="form-text text-danger">{{ $message }}</small> 
            @enderror 
            <div class="input-group mb-3">
                <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                </div>
                <input type="password" class="form-control" placeholder="Confirm Password" name="password_confirmation" id="confirmPassword" @if($errors->has('password_confirmation')) value="" @else value="{{ old('password_confirmation') }}" @endif>
                <button type="button" style="border: none" class="btn btn-light" id="tampilButtonConfirm">
                    <span class="fas fa-eye"></span>
                </button>
            </div>
            @error('password_confirmation')
                <small class="form-text text-danger">{{ $message }}</small> 
            @enderror 
            <button class="btn font-weight-bold btn-block mt-3 mb-3" style="height: 50px; background-color: #828282; font-size: 20px">REGISTER</button>
            <div class=" text-center">
                Kembali ke <a href="{{ route('login')}}" >Login</a>
              </div> 
          </form>
    </div>
  </div>

  <script>
    const passwordInput = document.getElementById('inputPassword');
    const confirmPasswordInput = document.getElementById('confirmPassword');
    const togglePassword = document.getElementById('tampilButton');
    const togglePasswordConfirm = document.getElementById('tampilButtonConfirm');

    togglePassword.addEventListener('click', function() {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        togglePassword.innerHTML = type === 'password' ? '<span class="fas fa-eye"></span>' : '<span class="fas fa-eye-slash"></span>';
    });

    togglePasswordConfirm.addEventListener('click', function() {
        const type = confirmPasswordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        confirmPasswordInput.setAttribute('type', type);
        togglePasswordConfirm.innerHTML = type === 'password' ? '<span class="fas fa-eye"></span>' : '<span class="fas fa-eye-slash"></span>';
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