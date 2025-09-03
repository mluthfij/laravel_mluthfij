@extends('content')

@section('title', 'Patients')

@section('content')
<div class="container py-4">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h2 text-dark fw-bold mb-0">Data Pasien</h1>
    <a href="{{ route('patients.create') }}" class="btn btn-primary">
      <i class="bi bi-plus-circle me-2"></i>Create Patient
    </a>
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
          <tbody>
            @foreach ($patients as $patient)
              <tr>
                <td class="fw-semibold text-dark">{{ $patient->id }}</td>
                <td class="text-dark">{{ $patient->name }}</td>
                <td class="text-dark">{{ $patient->adress }}</td>
                <td class="text-dark">{{ $patient->phone_number }}</td>
                <td class="text-dark">{{ $patient->hospital->name }}</td>
                <td class="text-center">
                  <div class="btn-group" role="group">
                    <a href="{{ route('patients.show', $patient->id) }}" class="btn btn-outline-info btn-sm">
                      <i class="bi bi-eye me-1"></i>Show
                    </a>
                    <a href="{{ route('patients.edit', $patient->id) }}" class="btn btn-outline-warning btn-sm">
                      <i class="bi bi-pencil me-1"></i>Edit
                    </a>
                    <button type="button" class="btn btn-outline-danger btn-sm delete-patient" 
                            data-id="{{ $patient->id }}" 
                            data-name="{{ $patient->name }}">
                      <i class="bi bi-trash me-1"></i>Delete
                    </button>
                  </div>
                </td>
              </tr>
            @endforeach
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