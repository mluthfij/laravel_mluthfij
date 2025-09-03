@extends('content')

@section('title', 'Hospitals')

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
    <h1 class="h2 text-dark fw-bold mb-0">Data Rumah Sakit</h1>
    <a href="{{ route('hospitals.create') }}" class="btn btn-primary">
      <i class="bi bi-plus-circle me-2"></i>Create Hospital
    </a>
  </div>

  <div class="card shadow-sm">
    <div class="card-body p-0">
      <div class="table-responsive">
        <table class="table table-hover mb-0">
          <thead class="table-dark">
            <tr>
              <th class="border-0">ID</th>
              <th class="border-0">Nama Rumah Sakit</th>
              <th class="border-0">Alamat</th>
              <th class="border-0">Email</th>
              <th class="border-0">Telepon</th>
              <th class="border-0 text-center">Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($hospitals as $hospital)
              <tr>
                <td class="fw-semibold text-dark">{{ $hospital->id }}</td>
                <td class="text-dark">{{ $hospital->name }}</td>
                <td class="text-dark">{{ $hospital->adress }}</td>
                <td class="text-dark">{{ $hospital->email }}</td>
                <td class="text-dark">{{ $hospital->phone_number }}</td>
                <td class="text-center">
                  <div class="btn-group" role="group">
                    <a href="{{ route('hospitals.show', $hospital->id) }}" class="btn btn-outline-info btn-sm">
                      <i class="bi bi-eye me-1"></i>Show
                    </a>
                    <a href="{{ route('hospitals.edit', $hospital->id) }}" class="btn btn-outline-warning btn-sm">
                      <i class="bi bi-pencil me-1"></i>Edit
                    </a>
                    <button type="button" class="btn btn-outline-danger btn-sm delete-hospital" 
                            data-id="{{ $hospital->id }}" 
                            data-name="{{ $hospital->name }}">
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