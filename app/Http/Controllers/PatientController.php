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
    public function index()
    {
        $patients = Patient::all();
        return view('patients.index', compact('patients'));
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
        Patient::create($request->all());
        return redirect()->route('patients.index')->with('success', 'patient created successfully.');
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
        return redirect()->route('patients.show', $patient->id)->with('success', 'patient berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(patient $patient)
    {
        $patient->delete();
        return redirect()->route('patients.index')->with('success', 'patient telah dihapus.');
    }
}
