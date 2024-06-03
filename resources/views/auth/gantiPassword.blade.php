@extends('layout.template') 
 
@section('content') 
  <div class="card card-outline "> 
    <div class="card-header"> 
      <h3 class="card-title">{{ $page->title }}</h3> 
      <div class="card-tools"></div> 
    </div> 
    <div class="card-body"> 
      <form method="POST" action="{{ url('/proses_ganti') }}" class="form-horizontal"> 
        @csrf {!! method_field('PUT') !!}  <!-- tambahkan baris ini untuk proses edit yang butuh method PUT --> 
        <div class="input-group mb-3">
          <div class="input-group-text">
              <span class="fas fa-lock"></span>
          </div>
          <input type="password" class="form-control" placeholder="Password Lama" name="password_lama" id="inputPasswordLama" @if($errors->has('password_lama')) value="" @else value="{{ old('password_lama') }}" @endif>
          <button type="button" style="border: none" class="btn btn-light" id="tampilButtonLama">
                  <span class="fas fa-eye"></span>
          </button>
      </div>
      @error('password_lama')
          <small class="form-text text-danger">{{ $message }}</small> 
      @enderror 
      <div class="input-group mb-3">
        <div class="input-group-text">
            <span class="fas fa-lock"></span>
        </div>
        <input type="password" class="form-control" placeholder="Password Baru" name="password" id="inputPasswordBaru" @if($errors->has('password')) value="" @else value="{{ old('password') }}" @endif>
        <button type="button" style="border: none" class="btn btn-light" id="tampilButtonBaru">
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
          <input type="password" class="form-control" placeholder="Confirm Password Baru" name="password_confirmation" id="confirmPassword" @if($errors->has('password_confirmation')) value="" @else value="{{ old('password_confirmation') }}" @endif>
          <button type="button" style="border: none" class="btn btn-light" id="tampilButtonConfirm">
              <span class="fas fa-eye"></span>
          </button>
      </div>
      @error('password_confirmation')
          <small class="form-text text-danger">{{ $message }}</small> 
      @enderror 
        <div class="form-group row"> 
          <div class="col-11"> 
            <button type="submit" class="btn btn-primary d-block btn-sm">Simpan</button> 
          </div> 
        </div> 
      </form> 
    </div> 
  </div> 
  <script>
    const confirmPasswordInput = document.getElementById('confirmPassword');
    const togglePasswordConfirm = document.getElementById('tampilButtonConfirm');

    const passwordInputLama = document.getElementById('inputPasswordLama');
    const togglePasswordLama = document.getElementById('tampilButtonLama');

    const passwordInputBaru = document.getElementById('inputPasswordBaru');
    const togglePasswordBaru = document.getElementById('tampilButtonBaru');

    togglePasswordBaru.addEventListener('click', function() {
        const type = passwordInputBaru.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInputBaru.setAttribute('type', type);
        togglePasswordBaru.innerHTML = type === 'password' ? '<span class="fas fa-eye"></span>' : '<span class="fas fa-eye-slash"></span>';
    });
    
    togglePasswordLama.addEventListener('click', function() {
        const type = passwordInputLama.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInputLama.setAttribute('type', type);
        togglePasswordLama.innerHTML = type === 'password' ? '<span class="fas fa-eye"></span>' : '<span class="fas fa-eye-slash"></span>';
    });

    togglePasswordConfirm.addEventListener('click', function() {
        const type = confirmPasswordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        confirmPasswordInput.setAttribute('type', type);
        togglePasswordConfirm.innerHTML = type === 'password' ? '<span class="fas fa-eye"></span>' : '<span class="fas fa-eye-slash"></span>';
    });
</script>
@endsection 

@push('css') 
@endpush 
@push('js') 
@endpush 