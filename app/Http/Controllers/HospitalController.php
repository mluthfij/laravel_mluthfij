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
        
        $hospital = Hospital::create($request->all());
        
        return redirect()->route('hospitals.index')->with('success', 'Rumah sakit berhasil ditambahkan!');
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
        
        return redirect()->route('hospitals.show', $hospital->id)->with('success', 'Data rumah sakit berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Hospital $hospital)
    {
        try {
            // Debug logging
            \Log::info('Delete request received', [
                'hospital_id' => $hospital->id,
                'is_ajax' => request()->ajax(),
                'wants_json' => request()->wantsJson(),
                'x_requested_with' => request()->header('X-Requested-With'),
                'content_type' => request()->header('Content-Type')
            ]);
            
            $hospital->delete();
            
            if (request()->ajax() || request()->wantsJson() || request()->header('X-Requested-With') === 'XMLHttpRequest') {
                \Log::info('Returning JSON response');
                return response()->json([
                    'success' => true,
                    'message' => 'Hospital berhasil dihapus.'
                ]);
            }
            
            \Log::info('Returning redirect response');
            return redirect()->route('hospitals.index')->with('success', 'Hospital telah dihapus.');
        } catch (\Exception $e) {
            \Log::error('Delete error', ['error' => $e->getMessage()]);
            
            if (request()->ajax() || request()->wantsJson() || request()->header('X-Requested-With') === 'XMLHttpRequest') {
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal menghapus hospital: ' . $e->getMessage()
                ], 500);
            }
            
            return redirect()->route('hospitals.index')->with('error', 'Gagal menghapus hospital.');
        }
    }
}
