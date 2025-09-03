@extends('content')

@section('title', 'Patients')

@section('content')
<div class="my-4">
  <h1 class="mb-4 text-center">Data Pasien</h1>
  <a href="{{ route('patients.create') }}" class="btn btn-primary">Create</a>

  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>Nama Pasien</th>
        <th>Alamat</th>
        <th>No Telepon</th>
        <th>Nama Rumah Sakit</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($patients as $patient)
        <tr>
          <td>{{ $patient->id }}</td>
          <td>{{ $patient->name }}</td>
          <td>{{ $patient->adress }}</td>
          <td>{{ $patient->phone_number }}</td>
          <td>{{ $patient->hospital->name }}</td>
          <td>
            <a href="{{ route('patients.show', $patient->id) }}">Show</a> |
            <a href="{{ route('patients.edit', $patient->id) }}">Edit</a> |
            <form action="{{ route('patients.destroy', $patient->id) }}" method="post"  onsubmit="return confirm('Apakah anda yakin ingin menghapus patient ini?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
            </form>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection