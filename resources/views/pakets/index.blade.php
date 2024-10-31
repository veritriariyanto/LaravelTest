<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Paket Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            height: 100vh;
            overflow-y: auto;
        }

        .sidebar {
            height: 100%;
            position: fixed;
            z-index: 100;
        }

        .content {
            margin-left: 280px;
            padding: 20px;
            height: 100vh;
            overflow-y: auto;
        }

        .card-header {
            background-color: #343a40;
        }

        .table th,
        .table td {
            vertical-align: middle;
        }

        .img-destination {
            height: 100px;
            width: auto;
        }
    </style>
</head>

<body class="bg-dark text-light">

    <!-- Navbar -->
    @include('components.navbar')

    <!-- Sidebar and Content Wrapper -->
    <div class="container-fluid mt-5">
        <div class="row">
            <!-- Sidebar -->
            @include('components.sidebar')

            <!-- Main Content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div
                    class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center mt-1 pt-1 pb-1 mb-1 border-bottom border-light">
                    <h2 class="text-white h3">Data Paket</h2>
                </div>

                <!-- Card for Counts -->
                <div class="row mb-4">
                    <div class="col-md-4">
                        <div class="card bg-primary text-white">
                            <div class="card-body">
                                <h5 class="card-title">Total Hotels</h5>
                                <p class="card-text">{{ $totalHotels }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card bg-success text-white">
                            <div class="card-body">
                                <h5 class="card-title">Total Destinations</h5>
                                <p class="card-text">{{ $totalDestinations }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card bg-warning text-white">
                            <div class="card-body">
                                <h5 class="card-title">Total Transports</h5>
                                <p class="card-text">{{ $totalTransports }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card for Actions and Table -->
                <div class="card bg-dark border-0 text-light mb-4">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Paket List</h5>
                            <a href="{{ route('pakets.create') }}" class="btn btn-success">ADD PAKET</a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-dark table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">NAMA PAKET</th>
                                    <th scope="col">DESKRIPSI</th>
                                    <th scope="col">HARGA TOTAL</th>
                                    <th scope="col">DESTINASI</th>
                                    <th scope="col">HOTEL</th>
                                    <th scope="col">TRANSPORT</th>
                                    <th scope="col">RATING</th>
                                    <th scope="col">ULASAN</th> <!-- Menambahkan Ulasan -->
                                    <th scope="col">TOTAL PEMBELIAN</th> <!-- Menambahkan Total Pembelian -->
                                    <th scope="col" style="width: 20%">AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($pakets as $paket)
                                    <tr>
                                        <td>{{ $paket->nama_paket }}</td>
                                        <td>{{ $paket->deskripsi }}</td>
                                        <td>Rp {{ number_format($paket->harga_total, 2, ',', '.') }}</td>
                                        <td>{{ $paket->destination->nama_destinasi ?? 'N/A' }}</td>
                                        <td>{{ $paket->hotel->nama_hotel ?? 'N/A' }}</td>
                                        <td>{{ $paket->transport->nama_transport ?? 'N/A' }}</td>
                                        <td>{{ $paket->rating }}</td>
                                        <td>{{ $paket->ulasan }}</td> <!-- Menampilkan Ulasan -->
                                        <td>{{ $paket->total_pembelian }}</td> <!-- Menampilkan Total Pembelian -->
                                        <td>
                                            <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                                                action="{{ route('pakets.destroy', $paket->id) }}" method="POST">
                                                <a href="{{ route('pakets.edit', $paket->id) }}"
                                                    class="btn btn-primary btn-sm">EDIT</a>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">DELETE</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="10" class="text-center">
                                            <div class="alert alert-danger">
                                                Data Paket belum Tersedia.
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    {{ $pakets->links('pagination.custom-pagination') }} <!-- Pagination -->
                </div>
            </main>
        </div>
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        @if (session('success'))
            Swal.fire({
                icon: "success",
                title: "BERHASIL",
                text: "{{ session('success') }}",
                showConfirmButton: false,
                timer: 2000
            });
        @elseif (session('error'))
            Swal.fire({
                icon: "error",
                title: "GAGAL!",
                text: "{{ session('error') }}",
                showConfirmButton: false,
                timer: 2000
            });
        @endif
    </script>

</body>

</html>
