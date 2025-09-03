@extends('content')

@section('title', 'Show patient')

@section('content')
<div class="container py-4">
  <div class="row justify-content-center">
    <div class="col-lg-8">
      <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h2 text-dark fw-bold mb-0">
          <i class="bi bi-person me-2"></i>Data Pasien
        </h1>
        <a href="{{ route('patients.index') }}" class="btn btn-outline-secondary">
          <i class="bi bi-arrow-left me-2"></i>Back to List
        </a>
      </div>

      <div class="card shadow-sm">
        <div class="card-body">
          <div class="row">
            <div class="col-md-6">
              <div class="mb-3">
                <label class="form-label text-muted fw-semibold">ID</label>
                <p class="form-control-plaintext text-dark fw-bold fs-5">{{ $patient->id }}</p>
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label class="form-label text-muted fw-semibold">Nama Pasien</label>
                <p class="form-control-plaintext text-dark fw-bold fs-5">{{ $patient->name }}</p>
              </div>
            </div>
          </div>
          
          <div class="row">
            <div class="col-md-6">
              <div class="mb-3">
                <label class="form-label text-muted fw-semibold">Alamat</label>
                <p class="form-control-plaintext text-dark">{{ $patient->address }}</p>
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label class="form-label text-muted fw-semibold">No Telepon</label>
                <p class="form-control-plaintext text-dark">{{ $patient->phone_number }}</p>
              </div>
            </div>
          </div>
          
          <div class="row">
            <div class="col-md-6">
              <div class="mb-3">
                <label class="form-label text-muted fw-semibold">Nama Rumah Sakit</label>
                <p class="form-control-plaintext text-dark">{{ $patient->hospital->name }}</p>
              </div>
            </div>
          </div>
          
          <hr class="my-4">
          
          <div class="d-flex gap-2">
            <a href="{{ route('patients.edit', $patient->id) }}" class="btn btn-warning">
              <i class="bi bi-pencil me-2"></i>Edit Patient
            </a>
            <a href="{{ route('patients.index') }}" class="btn btn-outline-primary">
              <i class="bi bi-list me-2"></i>View All Patients
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection