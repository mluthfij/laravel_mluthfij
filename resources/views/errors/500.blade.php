@extends('content')

@section('title', 'Server Error')

@section('content')
<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-lg-6 text-center">
      <div class="card shadow-sm">
        <div class="card-body py-5">
          <!-- 500 Icon -->
          <div class="mb-4">
            <i class="bi bi-exclamation-octagon text-danger" style="font-size: 4rem;"></i>
          </div>
          
          <!-- Error Title -->
          <h1 class="h2 text-dark fw-bold mb-3">500</h1>
          <h2 class="h4 text-muted mb-4">Server Error</h2>
          
          <!-- Error Message -->
          <p class="text-muted mb-4">
            Maaf, terjadi kesalahan pada server. 
            Tim kami telah diberitahu dan sedang memperbaikinya.
          </p>
          
          <!-- Action Buttons -->
          <div class="d-flex gap-3 justify-content-center">
            <a href="{{ route('hospitals.index') }}" class="btn btn-primary">
              <i class="bi bi-house me-2"></i>Kembali ke Beranda
            </a>
            <button onclick="location.reload()" class="btn btn-outline-secondary">
              <i class="bi bi-arrow-clockwise me-2"></i>Coba Lagi
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
