<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Hotels - SantriKoding.com</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body style="background: lightgray">

    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <form action="{{ route('hotels.update', $hotel->id) }}" method="POST"
                            enctype="multipart/form-data">

                            @csrf
                            @method('PUT')

                            <div class="form-group mb-3">
                                <label class="font-weight-bold">NAMA HOTEL</label>
                                <input type="text" class="form-control @error('nama_hotel') is-invalid @enderror"
                                    name="nama_hotel" value="{{ old('nama_hotel', $hotel->nama_hotel) }}"
                                    placeholder="Masukkan Nama Hotel">

                                <!-- error message untuk nama_hotel -->
                                @error('nama_hotel')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label class="font-weight-bold">ALAMAT</label>
                                <input type="text" class="form-control @error('alamat') is-invalid @enderror"
                                    name="alamat" value="{{ old('alamat', $hotel->alamat) }}"
                                    placeholder="Masukkan Alamat Hotel">

                                <!-- error message untuk alamat -->
                                @error('alamat')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label class="font-weight-bold">HARGA PER MALAM</label>
                                <input type="number" step="0.01"
                                    class="form-control @error('harga_per_malam') is-invalid @enderror"
                                    name="harga_per_malam" value="{{ old('harga_per_malam', $hotel->harga_per_malam) }}"
                                    placeholder="Masukkan Harga Per Malam">

                                <!-- error message untuk harga_per_malam -->
                                @error('harga_per_malam')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label class="font-weight-bold">DESTINATION</label>
                                <select class="form-control @error('destination_id') is-invalid @enderror"
                                    name="destination_id">
                                    <option value="">Pilih Destination</option>
                                    @foreach ($destinations as $destination)
                                        <option value="{{ $destination->id }}"
                                            {{ old('destination_id', $hotel->destination_id) == $destination->id ? 'selected' : '' }}>
                                            {{ $destination->nama_destinasi }}
                                        </option>
                                    @endforeach
                                </select>

                                <!-- error message untuk destination_id -->
                                @error('destination_id')
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
