<?php

namespace App\Http\Controllers;

use App\Models\Transports; // Import model Transport
use App\Models\Destinations; // Import model Destinations
use Illuminate\View\View; // Import return type View
use Illuminate\Http\Request; // Import Http Request
use Illuminate\Http\RedirectResponse; // Import return type RedirectResponse

class TransportsController extends Controller
{
    /**
     * Display a listing of transports.
     *
     * @return View
     */
    public function index(): View
    {
        $transports = Transports::with('destinations')->latest()->paginate(10);
        return view('transports.index', compact('transports'));
    }

    /**
     * Show the form for creating a new transport.
     *
     * @return View
     */
    public function create(): View
    {
        $destinations = Destinations::all(); // Get all destinations for dropdown
        return view('transports.create', compact('destinations'));
    }

    /**
     * Store a newly created transport in storage.
     *
     * @param  Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'nama_transport' => 'required|string|min:3|max:255',
            'tipe_transport' => 'required|string',
            'biaya' => 'required|numeric',
            'destination_id' => 'required|exists:destinations,id',
        ]);

        Transports::create($request->all());

        return redirect()->route('transports.index')->with('success', 'Data Transport Berhasil Disimpan!');
    }

    /**
     * Show the form for editing the specified transport.
     *
     * @param  string $id
     * @return View
     */
    public function edit(string $id): View
    {
        $transport = Transports::findOrFail($id); // Get transport by ID or fail
        $destinations = Destinations::all(); // Get all destinations for dropdown
        return view('transports.edit', compact('transport', 'destinations'));
    }

    /**
     * Update the specified transport in storage.
     *
     * @param  Request $request
     * @param  string $id
     * @return RedirectResponse
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $request->validate([
            'nama_transport' => 'required|string|min:3|max:255',
            'tipe_transport' => 'required|in:bis,travel,pesawat,kapal',
            'biaya' => 'required|numeric',
            'destination_id' => 'required|exists:destinations,id',
        ]);

        $transport = Transports::findOrFail($id); // Get transport by ID or fail
        $transport->update($request->all()); // Update transport

        return redirect()->route('transports.index')->with('success', 'Data Transport Berhasil Diubah!');
    }

    /**
     * Remove the specified transport from storage.
     *
     * @param  string $id
     * @return RedirectResponse
     */
    public function destroy(string $id): RedirectResponse
    {
        $transport = Transports::findOrFail($id); // Get transport by ID or fail
        $transport->delete(); // Delete transport

        return redirect()->route('transports.index')->with('success', 'Data Transport Berhasil Dihapus!');
    }
}
