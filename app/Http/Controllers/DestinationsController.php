<?php

namespace App\Http\Controllers;

// Import model Destination
use App\Models\Destinations;

// Import return type View
use Illuminate\View\View;

// Import return type RedirectResponse
use Illuminate\Http\Request;

// Import Http Request
use Illuminate\Http\RedirectResponse;

// Import Facades Storage
use Illuminate\Support\Facades\Storage;

class DestinationsController extends Controller
{
    /**
     * index
     *
     * @return View
     */
    public function index(): View
    {
        // Ambil semua destinasi
        $destinations = Destinations::latest()->paginate(10);

        // Render view dengan destinasi
        return view('destinations.index', compact('destinations'));
    }

    /**
     * create
     *
     * @return View
     */
    public function create(): View
    {
        return view('destinations.create');
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
            'image'         => 'required|image|mimes:jpeg,jpg,png|max:2048',
            'nama_destinasi' => 'required|string|min:3',
            'deskripsi'     => 'required|string|min:10',
            'lokasi'        => 'required|string|max:255',
            'htm'           => 'required|numeric'
        ]);

        // Upload image
        $image = $request->file('image');
        $image->storeAs('public/destinations/', $image->hashName());

        // Create destination
        Destinations::create([
            'image'         => $image->hashName(),
            'nama_destinasi' => $request->nama_destinasi,
            'deskripsi'     => $request->deskripsi,
            'lokasi'        => $request->lokasi,
            'htm'           => $request->htm
        ]);

        // Redirect to index
        return redirect()->route('destinations.index')->with(['success' => 'Data Destinasi Berhasil Disimpan!']);
    }

    /**
     * edit
     *
     * @param  string $id
     * @return View
     */
    public function edit(string $id): View
    {
        // Ambil destinasi berdasarkan ID
        $destination = Destinations::findOrFail($id);

        // Render view dengan destinasi
        return view('destinations.edit', compact('destination'));
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
            'image'         => 'image|mimes:jpeg,jpg,png|max:2048',
            'nama_destinasi' => 'required|string|min:3',
            'deskripsi'     => 'required|string|min:10',
            'lokasi'        => 'required|string|max:255',
            'htm'           => 'required|numeric'
        ]);

        // Ambil destinasi berdasarkan ID
        $destination = Destinations::findOrFail($id);

        // Cek jika image diupload
        if ($request->hasFile('image')) {
            // Upload image baru
            $image = $request->file('image');
            $image->storeAs('public/destinations/', $image->hashName());

            // Hapus image lama
            Storage::delete('public/destinations/' . $destination->image);

            // Update destinasi dengan image baru
            $destination->update([
                'image'         => $image->hashName(),
                'nama_destinasi' => $request->nama_destinasi,
                'deskripsi'     => $request->deskripsi,
                'lokasi'        => $request->lokasi,
                'htm'           => $request->htm
            ]);
        } else {
            // Update destinasi tanpa image
            $destination->update([
                'nama_destinasi' => $request->nama_destinasi,
                'deskripsi'     => $request->deskripsi,
                'lokasi'        => $request->lokasi,
                'htm'           => $request->htm
            ]);
        }

        // Redirect to index
        return redirect()->route('destinations.index')->with(['success' => 'Data Destinasi Berhasil Diubah!']);
    }

    /**
     * destroy
     *
     * @param  string $id
     * @return RedirectResponse
     */
    public function destroy(string $id): RedirectResponse
    {
        // Ambil destinasi berdasarkan ID
        $destination = Destinations::findOrFail($id);

        // Hapus image
        Storage::delete('public/destinations/' . $destination->image);

        // Hapus destinasi
        $destination->delete();

        // Redirect to index
        return redirect()->route('destinations.index')->with(['success' => 'Data Destinasi Berhasil Dihapus!']);
    }
}
