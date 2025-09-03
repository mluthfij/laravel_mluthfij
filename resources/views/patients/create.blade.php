@extends('content')

@section('title', 'Create Patient')

@section('content')
<div class="container py-4">
  <div class="row justify-content-center">
    <div class="col-lg-6">
      <div class="card shadow-sm">
        <div class="card-body">
          <h3 class="h4 text-dark fw-bold mb-4">
            <i class="bi bi-person-plus me-2"></i>Add a Patient
          </h3>
          
          <form action="{{ route('patients.store') }}" method="post">
            @csrf
            <div class="mb-3">
              <label for="name" class="form-label text-dark fw-semibold">Nama Pasien</label>
              <input type="text" id="name" name="name" required
                     class="form-control border-2" 
                     style="background-color: white; color: black;"
                     placeholder="Masukkan nama pasien">
            </div>
            
            <div class="mb-3">
              <label for="address" class="form-label text-dark fw-semibold">Alamat</label>
              <input type="text" id="address" name="address" required
                     class="form-control border-2" 
                     style="background-color: white; color: black;"
                     placeholder="Masukkan alamat pasien">
            </div>
            
            <div class="mb-3">
              <label for="phone_number" class="form-label text-dark fw-semibold">Telepon</label>
              <input type="tel" id="phone_number" name="phone_number" required
                     class="form-control border-2" 
                     style="background-color: white; color: black;"
                     placeholder="Masukkan nomor telepon">
            </div>
            
            <div class="mb-4">
              <label for="hospital_id" class="form-label text-dark fw-semibold">Rumah Sakit</label>
              <select id="hospital_id" name="hospital_id" required 
                      class="form-control border-2" 
                      style="background-color: white; color: black;">
                <option value="" disabled selected>Pilih Rumah Sakit</option>
                @foreach($hospitals as $hospital)
                  <option value="{{ $hospital->id }}">{{ $hospital->name }}</option>
                @endforeach
              </select>
            </div>
            
            <div class="d-flex gap-2">
              <button type="submit" class="btn btn-primary">
                <i class="bi bi-check-circle me-2"></i>Create Data
              </button>
              <a href="{{ route('patients.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left me-2"></i>Back
              </a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
