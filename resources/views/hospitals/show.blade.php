@extends('content')

@section('title', 'Show Hospital')

@section('content')
<div class="container py-4">
  @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  @endif
  
  @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <i class="bi bi-exclamation-circle me-2"></i>{{ session('error') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  @endif
  <div class="row justify-content-center">
    <div class="col-lg-8">
      <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h2 text-dark fw-bold mb-0">
          <i class="bi bi-hospital me-2"></i>Data Rumah Sakit
        </h1>
        <a href="{{ route('hospitals.index') }}" class="btn btn-outline-secondary">
          <i class="bi bi-arrow-left me-2"></i>Back to List
        </a>
      </div>

      <div class="card shadow-sm">
        <div class="card-body">
          <div class="row">
            <div class="col-md-6">
              <div class="mb-3">
                <label class="form-label text-muted fw-semibold">ID</label>
                <p class="form-control-plaintext text-dark fw-bold fs-5">{{ $hospital->id }}</p>
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label class="form-label text-muted fw-semibold">Nama Rumah Sakit</label>
                <p class="form-control-plaintext text-dark fw-bold fs-5">{{ $hospital->name }}</p>
              </div>
            </div>
          </div>
          
          <div class="row">
            <div class="col-md-6">
              <div class="mb-3">
                <label class="form-label text-muted fw-semibold">Alamat</label>
                <p class="form-control-plaintext text-dark">{{ $hospital->address }}</p>
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label class="form-label text-muted fw-semibold">Email</label>
                <p class="form-control-plaintext text-dark">{{ $hospital->email }}</p>
              </div>
            </div>
          </div>
          
          <div class="row">
            <div class="col-md-6">
              <div class="mb-3">
                <label class="form-label text-muted fw-semibold">Telepon</label>
                <p class="form-control-plaintext text-dark">{{ $hospital->phone_number }}</p>
              </div>
            </div>
          </div>
          
          <hr class="my-4">
          
          <div class="d-flex gap-2">
            <a href="{{ route('hospitals.edit', $hospital->id) }}" class="btn btn-warning">
              <i class="bi bi-pencil me-2"></i>Edit Hospital
            </a>
            <a href="{{ route('hospitals.index') }}" class="btn btn-outline-primary">
              <i class="bi bi-list me-2"></i>View All Hospitals
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


@endsection