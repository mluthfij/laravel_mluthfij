<?php

namespace App\Http\Controllers;

use App\Models\Hospital;
use Illuminate\Http\Request;

class HospitalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $hospitals = Hospital::all();
        return view('hospitals.index', compact('hospitals'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('hospitals.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:255'],
            'address' => 'required',
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:hospitals,email'],
            'phone_number' => 'required',
        ]);
        Hospital::create($request->all());
        return redirect()->route('hospitals.index')->with('success', 'Hospital created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Hospital $hospital)
    {
        return view('hospitals.show', compact('hospital'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Hospital $hospital)
    {
        return view('hospitals.edit', compact('hospital'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Hospital $hospital)
    {
        $request->validate([
            'name' => ['required', 'max:255'],
            'address' => 'required',
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:hospitals,email,' . $hospital->id],
            'phone_number' => 'required',
        ]);

        $hospital->update($request->except(['_token', '_method']));
        return redirect()->route('hospitals.show', $hospital->id)->with('success', 'hospital berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Hospital $hospital)
    {
        $hospital->delete();
        return redirect()->route('hospitals.index')->with('success', 'hospital telah dihapus.');
    }
}
