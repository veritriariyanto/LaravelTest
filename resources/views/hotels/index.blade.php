<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Hotels Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            height: 100vh;
            overflow-y: auto;
            /* Izinkan scroll vertikal */
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
            /* Izinkan scroll konten jika lebih panjang */
        }

        /* Tambahan styling untuk card header */
        .card-header {
            background-color: #343a40;
        }

        .table th,
        .table td {
            vertical-align: middle;
        }

        /* Styling untuk gambar destinasi */
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
                    <h2 class="text-white h3">Data Hotels</h2>
                </div>

                <!-- Card for Actions and Table -->
                <div class="card bg-dark border-0 text-light mb-4">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Hotels List</h5>
                            <a href="{{ route('hotels.create') }}" class="btn btn-success">ADD HOTEL</a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-dark table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">NAME</th>
                                    <th scope="col">ADDRESS</th>
                                    <th scope="col">PRICE PER NIGHT</th>
                                    <th scope="col">DESTINATION</th>
                                    <th scope="col" style="width: 20%">ACTIONS</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($hotels as $hotel)
                                    <tr>
                                        <td>{{ $hotel->nama_hotel }}</td>
                                        <td>{{ $hotel->alamat }}</td>
                                        <td>{{ 'Rp ' . number_format($hotel->harga_per_malam, 2, ',', '.') }}</td>
                                        <td>{{ $hotel->destination->nama_destinasi ?? 'N/A' }}</td>
                                        <td>
                                            <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                                                action="{{ route('hotels.destroy', $hotel->id) }}" method="POST">
                                                <a href="{{ route('hotels.edit', $hotel->id) }}"
                                                    class="btn btn-primary btn-sm">EDIT</a>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">DELETE</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">
                                            <div class="alert alert-danger">
                                                Data Hotels belum Tersedia.
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    {{ $hotels->links('pagination.custom-pagination') }} <!-- Pagination -->
                </div>
            </main>
        </div>
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
