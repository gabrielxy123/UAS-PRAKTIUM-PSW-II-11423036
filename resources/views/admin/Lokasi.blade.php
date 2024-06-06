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
                    <h1 class="mt-4">Tambah Lokasi</h1>
                    <p>Tambah lokasi dibawah ini</p>
                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#locationModal">
                        Tambah
                    </button>
                    <br>
                    @if(Session::has('success'))
                    <div class="alert alert-success">
                        {{ Session::get('success') }}
                    </div>
                    @endif
                    <div class="card-body">
                        <table id="table_id" class="dataTable table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Lokasi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($lokasi as $lok)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $lok->namaLokasi }}</td>
                                    <td>
                                        <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#editLocationModal" data-id="{{ $lok->id }}" data-name="{{ $lok->namaLokasi }}">Edit</button>
                                        <a href="{{ route('hapuslokasi', ['id' => $lok->id]) }}" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin?')">Hapus</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Add Location Modal -->
                    <div class="modal fade" id="locationModal" tabindex="-1" role="dialog" aria-labelledby="locationModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="locationModalLabel">Tambah Lokasi</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form id="locationForm" method="POST" action="{{ route('tambahlokasi')}}">
                                        @csrf
                                        <div class="form-group">
                                            <label for="nama_lokasi">Nama Lokasi:</label>
                                            <input type="text" class="form-control" id="nama_lokasi" name="namaLokasi" required>
                                        </div>
                                        @error('namaLokasi')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary" onclick="submitForm()">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Add Location Modal -->

                    <!-- Edit Location Modal -->
                    <div class="modal fade" id="editLocationModal" tabindex="-1" role="dialog" aria-labelledby="editLocationModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editLocationModalLabel">Edit Lokasi</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form id="editLocationForm" method="POST">
                                        @csrf
                                        @method('POST')
                                        <input type="hidden" id="edit_id" name="id">
                                        <div class="form-group">
                                            <label for="edit_nama_lokasi">Nama Lokasi:</label>
                                            <input type="text" class="form-control" id="edit_nama_lokasi" name="namaLokasi" required>
                                        </div>
                                        @error('namaLokasi')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary" onclick="submitEditForm()">Save changes</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Edit Location Modal -->

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

            $('#editLocationModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);
                var id = button.data('id');
                var name = button.data('name');
                
                var action = '{{ route("updatelokasi", ":id") }}';
                action = action.replace(':id', id);
                
                var modal = $(this);
                modal.find('#editLocationForm').attr('action', action);
                modal.find('#edit_id').val(id);
                modal.find('#edit_nama_lokasi').val(name);
            });
        });

        function submitForm() {
            document.getElementById('locationForm').submit();
        }

        function submitEditForm() {
            document.getElementById('editLocationForm').submit();
        }
    </script>
</body>
</html>
