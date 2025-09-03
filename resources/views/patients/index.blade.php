@extends('content')

@section('title', 'Patients')

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
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h2 text-dark fw-bold mb-0">Data Pasien</h1>
    <a href="{{ route('patients.create') }}" class="btn btn-primary">
      <i class="bi bi-plus-circle me-2"></i>Create Patient
    </a>
  </div>

  <!-- Filter Section -->
  <div class="card shadow-sm mb-4">
    <div class="card-body">
      <div class="row align-items-center">
        <div class="col-md-6">
          <label for="hospital-filter" class="form-label text-dark fw-semibold">
            <i class="bi bi-hospital me-2"></i>Filter berdasarkan Rumah Sakit:
          </label>
          <select id="hospital-filter" class="form-select">
            <option value="">Semua Rumah Sakit</option>
            @foreach($hospitals as $hospital)
              <option value="{{ $hospital->id }}" {{ $selectedHospital == $hospital->id ? 'selected' : '' }}>
                {{ $hospital->name }}
              </option>
            @endforeach
          </select>
        </div>
        <div class="col-md-6 d-flex align-items-end">
          <button type="button" id="clear-filter" class="btn btn-outline-secondary">
            <i class="bi bi-x-circle me-2"></i>Clear Filter
          </button>
        </div>
      </div>
    </div>
  </div>

  <div class="card shadow-sm">
    <div class="card-body p-0">
      <div class="table-responsive">
        <table class="table table-hover mb-0">
          <thead class="table-dark">
            <tr>
              <th class="border-0">ID</th>
              <th class="border-0">Nama Pasien</th>
              <th class="border-0">Alamat</th>
              <th class="border-0">No Telepon</th>
              <th class="border-0">Nama Rumah Sakit</th>
              <th class="border-0 text-center">Action</th>
            </tr>
          </thead>
          <tbody id="patient-table-body">
            @include('patients.partials.patient-table', ['patients' => $patients])
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<!-- SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Delete Manager JavaScript -->
<script src="{{ asset('js/delete-manager.js') }}"></script>
@endsection