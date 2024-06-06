@extends('layout.template') 
 
@section('content') 
  <div class="card card-outline "> 
    <div class="card-header"> 
      <h3 class="card-title">{{ $page->title }}</h3> 
      <div class="card-tools"></div> 
    </div> 
    <div class="card-body"> 
      <form method="POST" action="{{ url('user') }}" class="form-horizontal" enctype="multipart/form-data"> 
        @csrf 
        <div class="form-group row"> 
          <label class="col-2 control-label col-form-label">Level</label> 
          <div class="col-10"> 
            <select class="form-control" id="level_id" name="level_id" required> 
              <option value="">- Pilih Level -</option> 
              @foreach($level as $item) 
                <option value="{{ $item->level_id }}">{{ $item->level_nama }}</option> 
              @endforeach 
            </select> 
            @error('level_id')
              <small class="form-text text-danger">{{ $message }}</small> 
            @enderror 
          </div> 
        </div> 
        <div class="form-group row"> 
          <label class="col-2 control-label col-form-label">NIM</label> 
          <div class="col-10"> 
            <input type="text" class="form-control" id="nim" name="nim" placeholder="11111111" value="{{ old('nim') }}" pattern="\d*" inputmode="numeric" required> 
            @error('nim') 
              <small class="form-text text-danger">{{ $message }}</small> 
            @enderror 
          </div> 
        </div> 
        <div class="form-group row"> 
          <label class="col-2 control-label col-form-label">Nama User</label> 
          <div class="col-10"> 
            <input type="text" class="form-control" id="nama" name="nama" placeholder="Akbar Rahmadani" value="{{ old('nama') }}" pattern="[A-Za-z\s]+" required> 
            @error('nama') 
              <small class="form-text text-danger">{{ $message }}</small> 
            @enderror 
          </div> 
        </div> 
        <div class="form-group row"> 
          <label class="col-2 control-label col-form-label">Tanggal Lahir</label> 
          <div class="col-10"> 
            <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir" value="{{ old('tgl_lahir') }}" required> 
            @error('tgl_lahir') 
              <small class="form-text text-danger">{{ $message }}</small> 
            @enderror 
          </div> 
        </div> 
        <div class="form-group row"> 
          <label class="col-2 control-label col-form-label">Password</label> 
          <div class="col-10"> 
            <div class="d-flex">
              <input type="password" class="form-control" placeholder="*****" name="password" id="inputPassword" value="{{ old('password') }}">
              <button type="button" style="border: none" class="btn btn-light" id="tampilButton">
                <span class="fas fa-eye"></span>
              </button>
            </div>
            @error('password') 
              <small class="form-text text-danger">{{ $message }}</small> 
            @enderror 
          </div> 
        </div> 
        <div class="form-group row"> 
          <label class="col-1 control-label col-form-label"></label> 
          <div class="col-11"> 
            <button type="submit" class="btn btn-primary btn-sm">Simpan</button> 
            <a class="btn btn-sm btn-default ml-1" href="{{ url('user') }}">Kembali</a> 
          </div> 
        </div> 
     </form> 
    </div> 
  </div> 
@endsection 
@push('css') 
@endpush 
@push('js') 
<script>
  const passwordInput = document.getElementById('inputPassword');
  const togglePassword = document.getElementById('tampilButton');

  togglePassword.addEventListener('click', function() {
      const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
      passwordInput.setAttribute('type', type);
      togglePassword.innerHTML = type === 'password' ? '<span class="fas fa-eye"></span>' : '<span class="fas fa-eye-slash"></span>';
  });
</script>
@endpush 