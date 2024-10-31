<?php

namespace App\Http\Controllers;

use App\Models\Transports; // Import model Transport
use App\Models\Destinations; // Import model Destinations
use Illuminate\View\View; // Import return type View
use Illuminate\Http\Request; // Import Http Request
use Illuminate\Http\RedirectResponse; // Import return type RedirectResponse
use Illuminate\Support\Facades\Storage; // Import Facades Storage

class TransportsController extends Controller
{
    /**
     * index
     *
     * @return View
     */
    public function index(): View
    {
        $transports = Transports::with('destinations')->latest()->paginate(10);
        return view('transports.index', compact('transports'));
    }

    /**
     * create
     *
     * @return View
     */
    public function create(): View
    {
        // Ambil semua destinasi untuk dropdown
        $destinations = Destinations::all();
        return view('transports.create', compact('destinations'));
    }

    /**
     * store
     *
     * @param  Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        // Validasi form
        $request->validate([
            'nama_transport' => 'required|string|min:3|max:255',
            'tipe_transport' => 'required|in:bis,travel,pesawat,kapal',
            'destination_id' => 'required|exists:destinations,id',
        ]);

        // Create transport
        Transports::create($request->all());

        // Redirect to index
        return redirect()->route('transports.index')->with(['success' => 'Data Transport Berhasil Disimpan!']);
    }

    /**
     * edit
     *
     * @param  string $id
     * @return View
     */
    public function edit(string $id): View
    {
        // Ambil transport berdasarkan ID
        $transport = Transports::findOrFail($id);

        // Ambil semua destinasi untuk dropdown
        $destinations = Destinations::all();
        return view('transports.edit', compact('transport', 'destinations'));
    }

    /**
     * update
     *
     * @param  Request $request
     * @param  string $id
     * @return RedirectResponse
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        // Validasi form
        $request->validate([
            'nama_transport' => 'required|string|min:3|max:255',
            'tipe_transport' => 'required|in:bis,travel,pesawat,kapal',
            'destination_id' => 'required|exists:destinations,id',
        ]);

        // Ambil transport berdasarkan ID
        $transport = Transports::findOrFail($id);

        // Update transport
        $transport->update($request->all());

        // Redirect to index
        return redirect()->route('transports.index')->with(['success' => 'Data Transport Berhasil Diubah!']);
    }

    /**
     * destroy
     *
     * @param  string $id
     * @return RedirectResponse
     */
    public function destroy(string $id): RedirectResponse
    {
        // Ambil transport berdasarkan ID
        $transport = Transports::findOrFail($id);

        // Hapus transport
        $transport->delete();

        // Redirect to index
        return redirect()->route('transports.index')->with(['success' => 'Data Transport Berhasil Dihapus!']);
    }
}
