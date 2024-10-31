<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Paket</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background: lightgray">

    <div class="container mt-5">
        <h3 class="text-center my-4">Create Paket</h3>
        <hr>
        <div class="card border-0 shadow-sm rounded">
            <div class="card-body">
                <form action="{{ route('pakets.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="nama_paket" class="form-label">Nama Paket</label>
                        <input type="text" class="form-control @error('nama_paket') is-invalid @enderror" id="nama_paket" name="nama_paket" value="{{ old('nama_paket') }}" required>
                        @error('nama_paket')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi" rows="3" required>{{ old('deskripsi') }}</textarea>
                        @error('deskripsi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="harga_total" class="form-label">Harga Total</label>
                        <input type="number" class="form-control @error('harga_total') is-invalid @enderror" id="harga_total" name="harga_total" value="{{ old('harga_total') }}" required>
                        @error('harga_total')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="destination_id" class="form-label">Destination</label>
                        <select class="form-select @error('destination_id') is-invalid @enderror" id="destination_id" name="destination_id" required>
                            <option value="">Pilih Destination</option>
                            @foreach ($destinations as $destination)
                                <option value="{{ $destination->id }}">{{ $destination->nama_destinasi }}</option>
                            @endforeach
                        </select>
                        @error('destination_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="hotel_id" class="form-label">Hotel</label>
                        <select class="form-select @error('hotel_id') is-invalid @enderror" id="hotel_id" name="hotel_id" required>
                            <option value="">Pilih Hotel</option>
                            @foreach ($hotels as $hotel)
                                <option value="{{ $hotel->id }}">{{ $hotel->nama_hotel }}</option>
                            @endforeach
                        </select>
                        @error('hotel_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="transport_id" class="form-label">Transport</label>
                        <select class="form-select @error('transport_id') is-invalid @enderror" id="transport_id" name="transport_id" required>
                            <option value="">Pilih Transport</option>
                            @foreach ($transports as $transport)
                                <option value="{{ $transport->id }}">{{ $transport->nama_transport }}</option>
                            @endforeach
                        </select>
                        @error('transport_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="rating" class="form-label">Rating</label>
                        <input type="number" class="form-control @error('rating') is-invalid @enderror" id="rating" name="rating" value="{{ old('rating') }}" min="0" max="5">
                        @error('rating')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="ulasan" class="form-label">Ulasan</label>
                        <input type="number" class="form-control @error('ulasan') is-invalid @enderror" id="ulasan" name="ulasan" value="{{ old('ulasan') }}" min="0">
                        @error('ulasan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="total_pembelian" class="form-label">Total Pembelian</label>
                        <input type="number" class="form-control @error('total_pembelian') is-invalid @enderror" id="total_pembelian" name="total_pembelian" value="{{ old('total_pembelian') }}" min="0">
                        @error('total_pembelian')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-success">Create Paket</button>
                    <a href="{{ route('pakets.index') }}" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
