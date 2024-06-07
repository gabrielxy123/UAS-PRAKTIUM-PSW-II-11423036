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
                    <h1 class="mt-4">Daftar Lokasi</h1>
                    <br>
                    <div class="card-body">
                        <table id="table_id" class="dataTable table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Pengelola</th>
                                    <th>Lokasi Dikelola</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pengelola as $lok)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $lok->namaPengelola }}</td>
                                        <td>{{ $lok->lokasi->namaLokasi }}</td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('datatables/datatables.min.js') }}"></script>
</body>

</html>
