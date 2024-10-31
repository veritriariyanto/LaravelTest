<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Paket - BuzJet</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body style="background: lightgray">

    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <form action="{{ route('pakets.update', $paket->id) }}" method="POST">

                            @csrf
                            @method('PUT')

                            <!-- Paket Name -->
                            <div class="form-group mb-3">
                                <label class="font-weight-bold">PAKET NAME</label>
                                <input type="text" class="form-control @error('nama_paket') is-invalid @enderror"
                                    name="nama_paket" value="{{ old('nama_paket', $paket->nama_paket) }}"
                                    placeholder="Enter Paket Name">

                                @error('nama_paket')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Deskripsi -->
                            <div class="form-group mb-3">
                                <label class="font-weight-bold">DESKRIPSI</label>
                                <textarea class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi" placeholder="Enter Deskripsi">{{ old('deskripsi', $paket->deskripsi) }}</textarea>

                                @error('deskripsi')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Harga Total -->
                            <div class="form-group mb-3">
                                <label class="font-weight-bold">HARGA TOTAL</label>
                                <input type="text" class="form-control @error('harga_total') is-invalid @enderror"
                                    name="harga_total" value="{{ old('harga_total', $paket->harga_total) }}"
                                    placeholder="Enter Harga Total">

                                @error('harga_total')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Ulasan -->
                            <div class="form-group mb-3">
                                <label class="font-weight-bold">ULASAN</label>
                                <textarea class="form-control @error('ulasan') is-invalid @enderror" name="ulasan" placeholder="Enter Ulasan">{{ old('ulasan', $paket->ulasan) }}</textarea>

                                @error('ulasan')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Total Pembelian -->
                            <div class="form-group mb-3">
                                <label class="font-weight-bold">TOTAL PEMBELIAN</label>
                                <input type="number"
                                    class="form-control @error('total_pembelian') is-invalid @enderror"
                                    name="total_pembelian" value="{{ old('total_pembelian', $paket->total_pembelian) }}"
                                    placeholder="Enter Total Pembelian">

                                @error('total_pembelian')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Destination -->
                            <div class="form-group mb-3">
                                <label class="font-weight-bold">DESTINATION</label>
                                <select class="form-control @error('destination_id') is-invalid @enderror"
                                    name="destination_id">
                                    <option value="">Select Destination</option>
                                    @foreach ($destinations as $destination)
                                        <option value="{{ $destination->id }}"
                                            {{ old('destination_id', $paket->destination_id) == $destination->id ? 'selected' : '' }}>
                                            {{ $destination->nama_destinasi }}
                                        </option>
                                    @endforeach
                                </select>

                                @error('destination_id')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Hotel -->
                            <div class="form-group mb-3">
                                <label class="font-weight-bold">HOTEL</label>
                                <select class="form-control @error('hotel_id') is-invalid @enderror" name="hotel_id">
                                    <option value="">Select Hotel</option>
                                    @foreach ($hotels as $hotel)
                                        <option value="{{ $hotel->id }}"
                                            {{ old('hotel_id', $paket->hotel_id) == $hotel->id ? 'selected' : '' }}>
                                            {{ $hotel->nama_hotel }}
                                        </option>
                                    @endforeach
                                </select>

                                @error('hotel_id')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Transport -->
                            <div class="form-group mb-3">
                                <label class="font-weight-bold">TRANSPORT</label>
                                <select class="form-control @error('transport_id') is-invalid @enderror"
                                    name="transport_id">
                                    <option value="">Select Transport</option>
                                    @foreach ($transports as $transport)
                                        <option value="{{ $transport->id }}"
                                            {{ old('transport_id', $paket->transport_id) == $transport->id ? 'selected' : '' }}>
                                            {{ $transport->nama_transport }}
                                        </option>
                                    @endforeach
                                </select>

                                @error('transport_id')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Rating -->
                            <div class="form-group mb-3">
                                <label class="font-weight-bold">RATING</label>
                                <input type="number" class="form-control @error('rating') is-invalid @enderror"
                                    name="rating" value="{{ old('rating', $paket->rating) }}"
                                    placeholder="Enter Rating">

                                @error('rating')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-md btn-primary me-3">UPDATE</button>
                            <a href="{{ route('pakets.index') }}" class="btn btn-md btn-secondary">CANCEL</a>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
