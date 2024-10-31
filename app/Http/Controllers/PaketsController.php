<?php

namespace App\Http\Controllers;

use App\Models\Pakets;
use App\Models\Destinations;
use App\Models\Hotels;
use App\Models\Transports;
use Illuminate\Http\Request;

class PaketsController extends Controller
{
    public function index()
    {
        // Mengambil semua data paket dengan relasi untuk mengurangi query di view
        $pakets = Pakets::with(['destination', 'hotel', 'transport'])->paginate(10);

        // Menghitung total destinasi, hotel, dan transportasi
        $totalHotels = Hotels::count();
        $totalDestinations = Destinations::count();
        $totalTransports = Transports::count();

        return view('pakets.index', compact('pakets', 'totalHotels', 'totalDestinations', 'totalTransports'));
    }

    public function create()
    {
        // Mengambil data untuk dropdown
        $destinations = Destinations::all();
        $hotels = Hotels::all();
        $transports = Transports::all();
        return view('pakets.create', compact('destinations', 'hotels', 'transports'));
    }

    public function store(Request $request)
    {
        // Validasi data input
        $request->validate([
            'nama_paket' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'harga_total' => 'required|numeric',
            'destination_id' => 'required|exists:destinations,id',
            'hotel_id' => 'required|exists:hotels,id',
            'transport_id' => 'required|exists:transports,id',
            'rating' => 'nullable|integer|min:0|max:5', // Rating antara 0 dan 5
            'ulasan' => 'nullable|integer|min:0',
            'total_pembelian' => 'nullable|integer|min:0',
        ]);

        // Membuat paket baru
        Pakets::create($request->all());
        return redirect()->route('pakets.index')->with('success', 'Paket created successfully.');
    }

    public function edit(Pakets $paket)
    {
        // Mengambil data untuk dropdown
        $destinations = Destinations::all();
        $hotels = Hotels::all();
        $transports = Transports::all();
        return view('pakets.edit', compact('paket', 'destinations', 'hotels', 'transports'));
    }

    public function update(Request $request, Pakets $paket)
    {
        // Validasi data input
        $request->validate([
            'nama_paket' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'harga_total' => 'required|numeric',
            'destination_id' => 'required|exists:destinations,id',
            'hotel_id' => 'required|exists:hotels,id',
            'transport_id' => 'required|exists:transports,id',
            'rating' => 'nullable|integer|min:0|max:5', // Rating antara 0 dan 5
            'ulasan' => 'nullable|integer|min:0',
            'total_pembelian' => 'nullable|integer|min:0',
        ]);

        // Memperbarui paket
        $paket->update($request->all());
        return redirect()->route('pakets.index')->with('success', 'Paket updated successfully.');
    }

    public function destroy(Pakets $paket)
    {
        // Menghapus paket
        $paket->delete();
        return redirect()->route('pakets.index')->with('success', 'Paket deleted successfully.');
    }
}
