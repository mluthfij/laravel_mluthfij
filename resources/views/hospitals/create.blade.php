@extends('content')

@section('title', 'Create Hospital')

@section('content')
<div class="container py-4">
  <div class="row justify-content-center">
    <div class="col-lg-6">
      <div class="card shadow-sm">
        <div class="card-body">
          <h3 class="h4 text-dark fw-bold mb-4">
            <i class="bi bi-hospital me-2"></i>Add a Hospital
          </h3>
          
          <form action="{{ route('hospitals.store') }}" method="post">
            @csrf
            <div class="mb-3">
              <label for="name" class="form-label text-dark fw-semibold">Nama Rumah Sakit</label>
              <input type="text" id="name" name="name" required
                     class="form-control border-2" 
                     style="background-color: white; color: black;"
                     placeholder="Masukkan nama rumah sakit">
            </div>
            
            <div class="mb-3">
              <label for="address" class="form-label text-dark fw-semibold">Alamat</label>
              <input type="text" id="address" name="address" required
                     class="form-control border-2" 
                     style="background-color: white; color: black;"
                     placeholder="Masukkan alamat rumah sakit">
            </div>
            
            <div class="mb-3">
              <label for="email" class="form-label text-dark fw-semibold">Email</label>
              <input type="email" id="email" name="email" required
                     class="form-control border-2" 
                     style="background-color: white; color: black;"
                     placeholder="Masukkan email rumah sakit">
            </div>
            
            <div class="mb-4">
              <label for="phone_number" class="form-label text-dark fw-semibold">Telepon</label>
              <input type="tel" id="phone_number" name="phone_number" required
                     class="form-control border-2" 
                     style="background-color: white; color: black;"
                     placeholder="Masukkan nomor telepon">
            </div>
            
            <div class="d-flex gap-2">
              <button type="submit" class="btn btn-primary">
                <i class="bi bi-check-circle me-2"></i>Create Data
              </button>
              <a href="{{ route('hospitals.index') }}" class="btn btn-outline-secondary">
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
