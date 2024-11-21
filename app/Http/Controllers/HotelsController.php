<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Destination;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class HotelsController extends Controller
{
    public function index(): View
    {

        // Mengambil data hotels untuk ditampilkan di tabel
        $hotels = Hotel::with('destination')->paginate(10); // Menampilkan 10 data per halaman

        return view('hotels.index', compact('hotels'));
    }

    public function create(): View
    {
        $destinations = Destination::all();
        return view('hotels.create', compact('destinations'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'nama_hotel' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'harga_per_malam' => 'required|numeric',
            'destination_id' => 'required|exists:destinations,id',
        ]);

        Hotel::create($request->all());

        return redirect()->route('hotels.index')->with('success', 'Hotel berhasil ditambahkan.');
    }

    public function edit(Hotel $hotel): View
    {
        $destinations = Destination::all();
        return view('hotels.edit', compact('hotel', 'destinations'));
    }

    public function update(Request $request, Hotel $hotel): RedirectResponse
    {
        $request->validate([
            'nama_hotel' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'harga_per_malam' => 'required|numeric',
            'destination_id' => 'required|exists:destinations,id',
        ]);

        $hotel->update($request->all());

        return redirect()->route('hotels.index')->with('success', 'Hotel berhasil diperbarui.');
    }

    public function destroy(Hotel $hotel): RedirectResponse
    {
        $hotel->delete();
        return redirect()->route('hotels.index')->with('success', 'Hotel berhasil dihapus.');
    }
}
