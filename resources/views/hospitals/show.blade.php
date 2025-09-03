@extends('content')

@section('title', 'Show Hospital')

@section('content')
<div class="my-4">
    <h1 class="mb-4 text-center">Data Rumah Sakit</h1>

    <p><strong>ID:</strong> {{ $hospital->id }} </p>
    <p><strong>Nama Rumah Sakit:</strong> {{ $hospital->name }} </p>
    <p><strong>Alamat:</strong> {{ $hospital->address }} </p>
    <p><strong>Email:</strong> {{ $hospital->email }} </p>
    <p><strong>Telepon:</strong> {{ $hospital->phone_number }} </p>
</div>
@endsection