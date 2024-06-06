<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('datatables/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <style>
        body {
            font-size: 0.875rem;
        }

        .sidebar {
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            width: 250px;
            background-color: #343a40;
            color: #fff;
        }

        .sidebar a {
            color: #fff;
            text-decoration: none;
        }

        .sidebar a:hover {
            background-color: #495057;
        }

        .content {
            margin-left: 250px;
            padding: 20px;
        }
    </style>
</head>

<body>
    @include('pengelola.sidebar')

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="mt-4">Daftar Booking</h1>
                    <p>Daftar Booking lapangan berdasarkan dibawah ini</p>
                    <br>
                    <div class="card-body">
                        <table id="table_id" class="dataTable table table-bordered">
                            @if (Session::has('success'))
                                <div class="alert alert-success">
                                    {{ Session::get('success') }}
                                </div>
                            @endif
                            @if (Session::has('error'))
                                <div class="alert alert-success">
                                    {{ Session::get('success') }}
                                </div>
                            @endif
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Pemesan</th>
                                    <th>No HP</th>
                                    <th>Nama Lapangan</th>
                                    <th>Lokasi</th>
                                    <th>Waktu Mulai</th>
                                    <th>Waktu Selesai</th>
                                    <th>Harga Lapangan</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($booking as $bok)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $bok->namaPemesan }}</td>
                                        <td>{{ $bok->noHp }}</td>
                                        <td>{{ $bok->lapangan->namaLapangan }}</td>
                                        <td>{{ $bok->lokasi->namaLokasi }}</td>
                                        <td>{{ $bok->waktuMulai }}</td>
                                        <td>{{ $bok->waktuSelesai }}</td>
                                        <td>{{ $bok->hargaTotal }}</td>
                                        <td>{{ $bok->status }}</td>
                                        <td>
                                            @if ($bok->status == 'Menunggu Persetujuan')
                                                <form action="{{ route('terimabooking', $bok->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    <button type="submit" class="btn btn-primary btn-sm">Terima</button>
                                                </form>
                                                <br><br>
                                                <form action="{{ route('tolakbooking', $bok->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger btn-sm">Tolak</button>
                                                </form>
                                            @else
                                                {{ $bok->status }}
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>



</body>

</html>
