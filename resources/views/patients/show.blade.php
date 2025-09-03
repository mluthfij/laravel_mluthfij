@extends('content')

@section('title', 'Show patient')

@section('content')
<div class="my-4">
    <h1 class="mb-4 text-center">Data Pasien</h1>

    <p><strong>ID:</strong> {{ $patient->id }} </p>
    <p><strong>Nama Pasien:</strong> {{ $patient->name }} </p>
    <p><strong>Alamat:</strong> {{ $patient->address }} </p>
    <p><strong>No Telepon:</strong> {{ $patient->phone_number }} </p>
    <p><strong>Nama Rumah Sakit:</strong> {{ $patient->hospital->name }} </p>
</div>
@endsection