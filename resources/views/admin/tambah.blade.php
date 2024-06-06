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
                    <h1 class="mt-4">Tambah Pengelola</h1>
                    <p>Tambah pengelola dibawah ini</p>
                    <a href="#" class="btn btn-info btn-sm" data-toggle="modal" data-target="#locationModal">Tambah</a>
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
                                    <th>Nama Pengelola</th>
                                    <th>Username</th>
                                    <th>Password</th>
                                    <th>Lokasi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pengelola as $user)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $user->namaPengelola }}</td>
                                    <td>{{ $user->username }}</a></td>
                                    <td>{{ $user->password }}</td>
                                    <td>{{ $user->lokasi->namaLokasi ?? 'Undefined'}}</td>
                                    <td>
                                        <button class="btn btn-info btn-sm" 
                                        data-toggle="modal" 
                                        data-target="#editModal" 
                                        data-id="{{ $user->id }}"
                                        data-namapengelola="{{ $user->namaPengelola }}"
                                        data-username="{{ $user->username }}"
                                        data-password="{{ $user->password }}"
                                        data-lokasi="{{ $user->lokasi_id }}">
                                        Edit
                                        </button>

                                        <a href="{{ route('hapuspengelola', ['id' => $user]) }}" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin?')">Hapus</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Tambah Pengelola Modal -->
                    <div class="modal fade" id="locationModal" tabindex="-1" role="dialog" aria-labelledby="locationModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="locationModalLabel">Tambah Pengelola</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form id="pengelolaForm" method="POST" action="{{ route('tambahpengelola') }}">
                                        @csrf
                                        <div class="form-group">
                                            <label for="nama_pengelola">Nama Pengelola:</label>
                                            <input type="text" class="form-control" id="nama_pengelola" name="namaPengelola" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="username">Username:</label>
                                            <input type="text" class="form-control" id="username" name="username" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="password">Password:</label>
                                            <input type="password" class="form-control" id="password" name="password" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="lokasi">Lokasi:</label>
                                            <select class="form-control" id="lokasi" name="lokasi" required>
                                                @foreach($lokasi as $lok)
                                                    <option value="{{ $lok->id }}">{{ $lok->namaLokasi }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary" onclick="submitForm()">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Edit Pengelola Modal -->
                    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editModalLabel">Edit Pengelola</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form id="editPengelolaForm" method="POST" action="/admin/Pengelola/update/{id}">
                                        @csrf
                                        @method('POST') <!-- Assuming update should be a PUT or PATCH request -->
                                        <input type="hidden" id="edit_id" name="id">
                                        <div class="form-group">
                                            <label for="edit_nama_pengelola">Nama Pengelola:</label>
                                            <input type="text" class="form-control" id="edit_nama_pengelola" name="namaPengelola" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="edit_username">Username:</label>
                                            <input type="text" class="form-control" id="edit_username" name="username" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="edit_password">Password:</label>
                                            <input type="password" class="form-control" id="edit_password" name="password" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="edit_lokasi">Lokasi:</label>
                                            <select class="form-control" id="edit_lokasi" name="lokasi" required>
                                                @foreach($lokasi as $lok)
                                                    <option value="{{ $lok->id }}">{{ $lok->namaLokasi }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary" onclick="submitEditForm()">Save changes</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('datatables/datatable.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#table_id').DataTable();
        });

        function submitForm() {
            document.getElementById('pengelolaForm').submit();
        }
        function submitEditForm() {
    document.getElementById('editPengelolaForm').submit();
}


        $('#editModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var id = button.data('id');
        var namaPengelola = button.data('namapengelola');
        var username = button.data('username');
        var password = button.data('password');
        var lokasi = button.data('lokasi');

        var modal = $(this);
        modal.find('#edit_id').val(id);
        modal.find('#edit_nama_pengelola').val(namaPengelola);
        modal.find('#edit_username').val(username);
        modal.find('#edit_password').val(password);
        modal.find('#edit_lokasi').val(lokasi);

        // Dynamically set the form action URL with the id
        var action = '{{ route("updatepengelola", ":id") }}';
        action = action.replace(':id', id);
        modal.find('#editPengelolaForm').attr('action', action);
    });
    </script>
</body>
</html>
