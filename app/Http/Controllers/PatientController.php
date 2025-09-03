<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Hospital;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $hospitals = Hospital::all();
        $selectedHospital = $request->get('hospital_id');
        
        $query = Patient::with('hospital');
        
        if ($selectedHospital) {
            $query->where('hospital_id', $selectedHospital);
        }
        
        $patients = $query->get();
        
        if ($request->ajax()) {
            \Log::info('AJAX request received', [
                'hospital_id' => $selectedHospital,
                'patients_count' => $patients->count()
            ]);
            
            return response()->json([
                'success' => true,
                'html' => view('patients.partials.patient-table', compact('patients'))->render()
            ]);
        }
        
        return view('patients.index', compact('patients', 'hospitals', 'selectedHospital'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $hospitals = Hospital::all();
        return view('patients.create', compact('hospitals'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:255'],
            'address' => 'required',
            'phone_number' => 'required',
            'hospital_id' => 'required',
        ]);
        
        $patient = Patient::create($request->all());
        
        return redirect()->route('patients.index')->with('success', 'Pasien berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(patient $patient)
    {
        return view('patients.show', compact('patient'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(patient $patient)
    {
        $hospitals = Hospital::all();
        return view('patients.edit', compact('patient', 'hospitals'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, patient $patient)
    {
        $request->validate([
            'name' => ['required', 'max:255'],
            'address' => 'required',
            'phone_number' => 'required',
            'hospital_id' => 'required',
        ]);

        $patient->update($request->except(['_token', '_method']));
        
        return redirect()->route('patients.show', $patient->id)->with('success', 'Data pasien berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Patient $patient)
    {
        try {
            // Debug logging
            \Log::info('Delete request received', [
                'patient_id' => $patient->id,
                'is_ajax' => request()->ajax(),
                'wants_json' => request()->wantsJson(),
                'x_requested_with' => request()->header('X-Requested-With'),
                'content_type' => request()->header('Content-Type')
            ]);
            
            $patient->delete();
            
            if (request()->ajax() || request()->wantsJson() || request()->header('X-Requested-With') === 'XMLHttpRequest') {
                \Log::info('Returning JSON response');
                return response()->json([
                    'success' => true,
                    'message' => 'Patient berhasil dihapus.'
                ]);
            }
            
            \Log::info('Returning redirect response');
            return redirect()->route('patients.index')->with('success', 'Patient telah dihapus.');
        } catch (\Exception $e) {
            \Log::error('Delete error', ['error' => $e->getMessage()]);
            
            if (request()->ajax() || request()->wantsJson() || request()->header('X-Requested-With') === 'XMLHttpRequest') {
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal menghapus patient: ' . $e->getMessage()
                ], 500);
            }
            
            return redirect()->route('patients.index')->with('error', 'Gagal menghapus patient.');
        }
    }
}
