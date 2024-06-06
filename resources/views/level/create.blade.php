@extends('layout.template') 
 
@section('content') 
  <div class="card card-outline "> 
    <div class="card-header"> 
      <h3 class="card-title">{{ $page->title }}</h3> 
      <div class="card-tools"></div> 
    </div> 
    <div class="card-body"> 
      <form method="POST" action="{{ url('level') }}" class="form-horizontal"> 
        @csrf 
        
        <div class="form-group row"> 
          <label class="col-1 control-label col-form-label">Kode Level</label> 
          <div class="col-11"> 
            <input type="text" class="form-control" id="level_kode" name="level_kode" value="{{ old('level_kode') }}" readonly> 
            @error('level_kode') 
              <small class="form-text text-danger">{{ $message }}</small> 
            @enderror 
          </div> 
        </div> 
        <div class="form-group row"> 
          <label class="col-1 control-label col-form-label">Nama Level</label> 
          <div class="col-11"> 
            <input type="text" class="form-control" id="level_nama" name="level_nama" placeholder="Nama Level" value="{{ old('level_nama') }}" pattern="[A-Za-z\s]+" required> 
            @error('level_nama') 
              <small class="form-text text-danger">{{ $message }}</small> 
            @enderror 
          </div> 
        </div> 
        <div class="form-group row"> 
          <label class="col-1 control-label col-form-label"></label> 
          <div class="col-11"> 
            <button type="submit" class="btn btn-primary btn-sm">Simpan</button> 
            <a class="btn btn-sm btn-default ml-1" href="{{ url('level') }}">Kembali</a> 
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
  const lastLevelId = {{ $lastId }} + 1;
  const levelId = lastLevelId.toString().padStart(3, '0');
  const levelKodeInput = document.getElementById('level_kode');
  levelKodeInput.value = 'LV' + (levelId)
</script>
@endpush 