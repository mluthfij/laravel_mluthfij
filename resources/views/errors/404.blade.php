@extends('content')

@section('title', 'Halaman Tidak Ditemukan')

@section('content')
<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-lg-6 text-center">
      <div class="card shadow-sm">
        <div class="card-body py-5">
          <!-- 404 Icon -->
          <div class="mb-4">
            <i class="bi bi-exclamation-triangle text-warning" style="font-size: 4rem;"></i>
          </div>
          
          <!-- Error Title -->
          <h1 class="h2 text-dark fw-bold mb-3">404</h1>
          <h2 class="h4 text-muted mb-4">Halaman Tidak Ditemukan</h2>
          
          <!-- Error Message -->
          <p class="text-muted mb-4">
            Maaf, halaman yang Anda cari tidak ditemukan. 
            Mungkin halaman tersebut telah dipindahkan atau dihapus.
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
