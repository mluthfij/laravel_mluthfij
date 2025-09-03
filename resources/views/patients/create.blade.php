@extends('content')

@section('title', 'Create Patient')

@section('content')
<div class="container mx-auto h-100 mt-5">
  <div class="flex h-full justify-center items-center">
    <div class="w-full max-w-lg text-gray-900">
      <h3 class="text-2xl font-semibold mb-4">Add a Patient</h3>
      <form action="{{ route('patients.store') }}" method="post" class="space-y-4">
        @csrf
        <div>
          <label for="name" class="block mb-1 font-medium">Nama Pasien</label>
          <input type="text" id="name" name="name" required
                 class="w-full px-3 py-2 border border-gray-300 rounded bg-white text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>
        <div>
          <label for="address" class="block mb-1 font-medium">Alamat</label>
          <input type="text" id="address" name="address" required
                 class="w-full px-3 py-2 border border-gray-300 rounded bg-white text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>
        <div>
          <label for="phone_number" class="block mb-1 font-medium">Telepon</label>
          <input type="tel" id="phone_number" name="phone_number" required
                 class="w-full px-3 py-2 border border-gray-300 rounded bg-white text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>
        <div>
          <label for="hospital_id" class="block mb-1 font-medium">Rumah Sakit</label>
          <select id="hospital_id" name="hospital_id" required class="w-full px-3 py-2 border border-gray-300 rounded bg-white text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500">
            <option value="" disabled selected>Pilih Rumah Sakit</option>
            @foreach($hospitals as $hospital)
              <option value="{{ $hospital->id }}">{{ $hospital->name }}</option>
            @endforeach
          </select>
        </div>
        <div>
          <button type="submit"
                  class="px-4 py-2 bg-blue-600 text-white font-semibold rounded hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
            Create Data
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
