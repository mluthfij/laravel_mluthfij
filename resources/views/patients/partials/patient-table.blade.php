@if($patients->count() > 0)
    @foreach($patients as $patient)
        <tr>
            <td class="text-dark fw-bold">{{ $loop->iteration }}</td>
            <td class="text-dark fw-semibold">{{ $patient->name }}</td>
            <td class="text-dark">{{ $patient->address }}</td>
            <td class="text-dark">{{ $patient->phone_number }}</td>
            <td class="text-dark fw-semibold">{{ $patient->hospital->name }}</td>
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
@else
    <tr>
        <td colspan="6" class="text-center text-muted">Tidak ada data patient</td>
    </tr>
@endif
