@extends('content')

@section('title', 'Hospitals')

@section('content')
<div class="my-4">
  <h1 class="mb-4 text-center">Data Rumah Sakit</h1>
  <a href="{{ route('hospitals.create') }}" class="btn btn-primary">Create</a>

  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>Nama Rumah Sakit</th>
        <th>Alamat</th>
        <th>Email</th>
        <th>Telepon</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($hospitals as $hospital)
        <tr>
          <td>{{ $hospital->id }}</td>
          <td>{{ $hospital->name }}</td>
          <td>{{ $hospital->adress }}</td>
          <td>{{ $hospital->email }}</td>
          <td>{{ $hospital->phone_number }}</td>
          <td>
            <a href="{{ route('hospitals.show', $hospital->id) }}">Show</a> |
            <a href="{{ route('hospitals.edit', $hospital->id) }}">Edit</a> |
            <form action="{{ route('hospitals.destroy', $hospital->id) }}" method="post"  onsubmit="return confirm('Apakah anda yakin ingin menghapus hospital ini?')">
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