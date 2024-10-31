<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Transport Dashboard</title>
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
                    <h2 class="text-white h3">Data Transport</h2>
                </div>
                <!-- Card for Actions and Table -->
                <div class="card bg-dark border-0 text-light mb-4">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Transport List</h5>
                            <a href="{{ route('transports.create') }}" class="btn btn-success">ADD TRANSPORT</a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-dark table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">NAMA TRANSPORT</th>
                                    <th scope="col">TIPE</th>
                                    <th scope="col">HARGA PER HARI</th> <!-- Ubah sesuai dengan migrasi -->
                                    <th scope="col" style="width: 20%">AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($transports as $transport)
                                    <tr>
                                        <td>{{ $transport->nama_transport }}</td>
                                        <td>{{ $transport->tipe_transport }}</td> <!-- Ubah sesuai dengan migrasi -->
                                        <td>Rp {{ number_format($transport->biaya, 2, ',', '.') }}</td>
                                        <!-- Sesuaikan dengan nama kolom 'biaya' -->
                                        <td>
                                            <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                                                action="{{ route('transports.destroy', $transport->id) }}"
                                                method="POST">
                                                <a href="{{ route('transports.edit', $transport->id) }}"
                                                    class="btn btn-primary btn-sm">EDIT</a>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">DELETE</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">
                                            <div class="alert alert-danger">
                                                Data Transport belum Tersedia.
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                    </div>
                    {{ $transports->links('pagination.custom-pagination') }} <!-- Pagination -->
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
