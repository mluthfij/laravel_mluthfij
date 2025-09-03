@extends('content')

@section('title', 'Edit Hospital')

@section('content')
<div class="container py-4">
  <div class="row justify-content-center">
    <div class="col-lg-6">
      <div class="card shadow-sm">
        <div class="card-body">
          <h3 class="h4 text-dark fw-bold mb-4">
            <i class="bi bi-pencil-square me-2"></i>Edit Hospital
          </h3>
          
          <form action="{{ route('hospitals.update', $hospital->id) }}" method="post">
            @csrf
            @method('PUT')
            <div class="mb-3">
              <label for="name" class="form-label text-dark fw-semibold">Nama Rumah Sakit</label>
              <input type="text" id="name" name="name" required value="{{ $hospital->name }}"
                     class="form-control border-2" 
                     style="background-color: white; color: black;">
            </div>
            
            <div class="mb-3">
              <label for="address" class="form-label text-dark fw-semibold">Alamat</label>
              <input type="text" id="address" name="address" required value="{{ $hospital->address }}"
                     class="form-control border-2" 
                     style="background-color: white; color: black;">
            </div>
            
            <div class="mb-3">
              <label for="email" class="form-label text-dark fw-semibold">Email</label>
              <input type="email" id="email" name="email" required value="{{ $hospital->email }}"
                     class="form-control border-2" 
                     style="background-color: white; color: black;">
            </div>
            
            <div class="mb-4">
              <label for="phone_number" class="form-label text-dark fw-semibold">Telepon</label>
              <input type="tel" id="phone_number" name="phone_number" required value="{{ $hospital->phone_number }}"
                     class="form-control border-2" 
                     style="background-color: white; color: black;">
            </div>
            
            <div class="d-flex gap-2">
              <button type="submit" class="btn btn-primary">
                <i class="bi bi-check-circle me-2"></i>Update Data
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
