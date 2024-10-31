<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Transport - BuzJet</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body style="background: lightgray">

    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <form action="{{ route('transports.update', $transport->id) }}" method="POST">

                            @csrf
                            @method('PUT')

                            <div class="form-group mb-3">
                                <label class="font-weight-bold">TRANSPORT NAME</label>
                                <input type="text" class="form-control @error('nama_transport') is-invalid @enderror"
                                    name="nama_transport"
                                    value="{{ old('nama_transport', $transport->nama_transport) }}"
                                    placeholder="Enter Transport Name">

                                <!-- error message for transport name -->
                                @error('nama_transport')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label class="font-weight-bold">TRANSPORT TYPE</label>
                                <select class="form-control @error('tipe_transport') is-invalid @enderror"
                                    name="tipe_transport">
                                    <option value="">Select Transport Type</option>
                                    <option value="bis"
                                        {{ old('tipe_transport', $transport->tipe_transport) == 'bis' ? 'selected' : '' }}>
                                        Bis</option>
                                    <option value="travel"
                                        {{ old('tipe_transport', $transport->tipe_transport) == 'travel' ? 'selected' : '' }}>
                                        Travel</option>
                                    <option value="pesawat"
                                        {{ old('tipe_transport', $transport->tipe_transport) == 'pesawat' ? 'selected' : '' }}>
                                        Pesawat</option>
                                    <option value="kapal"
                                        {{ old('tipe_transport', $transport->tipe_transport) == 'kapal' ? 'selected' : '' }}>
                                        Kapal</option>
                                </select>

                                <!-- error message for transport type -->
                                @error('tipe_transport')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label class="font-weight-bold">DESTINATION</label>
                                <select class="form-control @error('destination_id') is-invalid @enderror"
                                    name="destination_id">
                                    <option value="">Select Destination</option>
                                    @foreach ($destinations as $destination)
                                        <option value="{{ $destination->id }}"
                                            {{ old('destination_id', $transport->destination_id) == $destination->id ? 'selected' : '' }}>
                                            {{ $destination->nama_destinasi }}
                                        </option>
                                    @endforeach
                                </select>

                                <!-- error message for destination_id -->
                                @error('destination_id')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-md btn-primary me-3">UPDATE</button>
                            <a href="{{ route('transports.index') }}" class="btn btn-md btn-secondary">CANCEL</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
