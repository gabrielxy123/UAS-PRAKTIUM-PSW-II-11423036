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
    @include('admin.sidebar')

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="mt-4">Tambah Lapangan</h1>
                    <p>Tambah lapangan berdasarkan lokasi dibawah ini</p>
                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#locationModal">
                        Tambah
                    </button>
                    <br>
                    @if (Session::has('success'))
                        <div class="alert alert-success">
                            {{ Session::get('success') }}
                        </div>
                    @endif
                    <div class="card-body">
                        <table id="table_id" class="dataTable table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Lapangan</th>
                                    <th>Harga Lapangan</th>
                                    <th>Lokasi</th>
                                    <th>Pengelola</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($lapangan as $lok)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $lok->namaLapangan }}</td>
                                        <td>{{ $lok->hargaLapangan }}</td>
                                        <td>{{ $lok->lokasi->namaLokasi }}</td>
                                        <td>{{ $lok->pengelola->namaPengelola }}</td>
                                        <td>
                                            <button type="button" class="btn btn-info btn-sm"
                                                onclick="openEditModal('{{ $lok->id }}', '{{ $lok->namaLapangan }}', '{{ $lok->hargaLapangan }}', '{{ $lok->lokasi->id }}', '{{ $lok->pengelola->id }}')">Edit</button>
                                            <a href="{{ route('hapuslapangan', ['id' => $lok]) }}"
                                                class="btn btn-danger btn-sm"
                                                onclick="return confirm('Apakah anda yakin?')">Hapus</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="locationModal" tabindex="-1" role="dialog"
                        aria-labelledby="locationModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="locationModalLabel">Tambah Lapangan</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form id="locationForm" method="POST" action="{{ route('tambahlapangan') }}">
                                        @csrf
                                        <div class="form-group">
                                            <label for="nama_lokasi">Nama Lapangan:</label>
                                            <input type="text" class="form-control" id="nama_lokasi"
                                                name="namaLapangan" required>
                                        </div>
                                        @error('namaLokasi')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                        <div class="form-group">
                                            <label for="nama_lokasi">Harga:</label>
                                            <input type="text" class="form-control" id="nama_lokasi"
                                                name="hargaLapangan" required>
                                        </div>
                                        {{-- error harga --}}
                                        <div class="form-group">
                                            <label for="lokasi">Lokasi:</label>
                                            <select class="form-control" id="lokasi" name="lokasi">
                                                @foreach ($lokasi as $lok)
                                                    <option value="{{ $lok->id }}">{{ $lok->namaLokasi }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="pengelola">Pengelola:</label>
                                            <select class="form-control" id="pengelola" name="pengelola" required>
                                                @foreach ($pengelola as $lok)
                                                    <option value="{{ $lok->id }}">{{ $lok->namaPengelola }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary"
                                        onclick="submitForm()">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Modal -->
                    <!-- Modal Edit -->
                    <div class="modal fade" id="editModal" tabindex="-1" role="dialog"
                        aria-labelledby="editModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editModalLabel">Edit Lapangan</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form id="editForm" method="POST" action="/admin/Lapangan/update/{id}">
                                        @csrf
                                        @method('POST')
                                        <div class="form-group">
                                            <label for="edit_nama_lokasi">Nama Lapangan:</label>
                                            <input type="text" class="form-control" id="edit_nama_lokasi"
                                                name="namaLapangan" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="edit_harga">Harga:</label>
                                            <input type="text" class="form-control" id="edit_harga"
                                                name="hargaLapangan" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="edit_lokasi">Lokasi:</label>
                                            <select class="form-control" id="edit_lokasi" name="lokasi" required>
                                                @foreach ($lokasi as $lok)
                                                    <option value="{{ $lok->id }}">{{ $lok->namaLokasi }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="edit_pengelola">Pengelola:</label>
                                            <select class="form-control" id="edit_pengelola" name="pengelola"
                                                required>
                                                @foreach ($pengelola as $lok)
                                                    <option value="{{ $lok->id }}">{{ $lok->namaPengelola }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <input type="hidden" id="lapangan_id" name="lapangan_id">
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary" onclick="submitEditForm()">Save
                                        changes</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Modal Edit -->

                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('datatables/datatables.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#table_id').DataTable();
        });

        function submitForm() {
            document.getElementById('locationForm').submit();
        }
    </script>
    <script>
        function openEditModal(id, namaLapangan, hargaLapangan, lokasi_id, pengelola_id) {
            $('#edit_nama_lokasi').val(namaLapangan);
            $('#edit_harga').val(hargaLapangan);
            $('#edit_lokasi').val(lokasi_id);
            $('#edit_pengelola').val(pengelola_id);
            $('#lapangan_id').val(id);
            $('#editModal').modal('show');
        }

        function submitEditForm() {
            // Mendapatkan nilai lapangan_id
            var lapanganId = document.getElementById('lapangan_id').value;
            // Mengubah aksi formulir
            var form = document.getElementById('editForm');
            form.action = '/admin/Lapangan/update/' + lapanganId;
            // Mengirimkan formulir
            form.submit();
        }
    </script>

</body>

</html>
