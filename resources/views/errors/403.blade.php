@extends('content')

@section('title', 'Akses Ditolak')

@section('content')
<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-lg-6 text-center">
      <div class="card shadow-sm">
        <div class="card-body py-5">
          <!-- 403 Icon -->
          <div class="mb-4">
            <i class="bi bi-shield-exclamation text-warning" style="font-size: 4rem;"></i>
          </div>
          
          <!-- Error Title -->
          <h1 class="h2 text-dark fw-bold mb-3">403</h1>
          <h2 class="h4 text-muted mb-4">Akses Ditolak</h2>
          
          <!-- Error Message -->
          <p class="text-muted mb-4">
            Maaf, Anda tidak memiliki izin untuk mengakses halaman ini. 
            Silakan hubungi administrator jika Anda merasa ini adalah kesalahan.
          </p>
          
          <!-- Action Buttons -->
          <div class="d-flex gap-3 justify-content-center">
            <a href="{{ route('hospitals.index') }}" class="btn btn-primary">
              <i class="bi bi-house me-2"></i>Kembali ke Beranda
            </a>
            <button onclick="history.back()" class="btn btn-outline-secondary">
              <i class="bi bi-arrow-left me-2"></i>Kembali
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
