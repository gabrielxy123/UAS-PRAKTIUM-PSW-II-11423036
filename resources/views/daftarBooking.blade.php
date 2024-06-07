<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Booking Lapangan</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('datatables/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
    <style>
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 80px;
            /* adjust the height as needed */
            background-color: #f8f9fa;
            z-index: 100;
        }

        .content {
            padding-top: 100px;
            /* adjust the padding as needed */
        }
    </style>
</head>

<body>
    <!-- ======= Header/Navbar ======= -->
  <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
    <div class="container">
      <a class="navbar-brand text-brand" href="#">Badminton</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarDefault" aria-controls="navbarDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarDefault">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="/member/index">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/booking">Booking</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('daftarbookindex')}}">Daftar Pesanan</a>
          </li>
        </ul>
        <ul class="navbar-nav ms-auto">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Login
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="/admin/login">Login Admin</a></li>
              <li><a class="dropdown-item" href="/pengelola/login">Login Pengelola</a></li>
              <li><a class="dropdown-item" href="/member/login">Login Member</a></li>
              <li><a class="dropdown-item" href="/member/logout">Logout</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </nav><!-- End Header/Navbar -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
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
                                    <th>Nama Pemesan</th>
                                    <th>Lokasi Lapangan</th>
                                    <th>Nama Lapangan</th>
                                    <th>Waktu Mulai</th>
                                    <th>Waktu Selesai</th>
                                    <th>Total Harga</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($daftarBooking as $lok)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $lok->namaPemesan }}</td>
                                        <td>{{ $lok->lokasi->namaLokasi }}</td>
                                        <td>{{ $lok->lapangan->namaLapangan }}</td>
                                        <td>{{ $lok->waktuMulai }}</td>
                                        <td>{{ $lok->waktuSelesai }}</td>
                                        <td>{{ $lok->hargaTotal }}</td>
                                        <td>{{ $lok->status }}</td>
                                        <td>
                                            @if ($lok->status == 'Menunggu Persetujuan')
                                            <button type="button" class="btn btn-info btn-sm"
                                            onclick="editBooking({{ $lok }})">Edit Pesanan</button>
                                            @else
                                                {{$lok->status}}
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

    <!-- Edit Booking Modal -->
    <div class="modal fade" id="editBookingModal" tabindex="-1" role="dialog" aria-labelledby="editBookingModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editBookingModalLabel">Edit Booking</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editBookingForm" method="POST" action="/daftarbooking/{id}">
                        @csrf
                        @method('POST')
                        <input type="hidden" name="id" id="bookingId">
                        <div class="form-group">
                            <label for="namaPemesan">Nama Pemesan</label>
                            <input type="text" class="form-control" id="namaPemesan" name="namaPemesan" required>
                        </div>
                        <div class="form-group">
                            <label for="namaLokasi">Lokasi Lapangan</label>
                            <input type="text" class="form-control" id="namaLokasi" name="namaLokasi" required>
                        </div>
                        <div class="form-group">
                            <label for="namaLapangan">Nama Lapangan</label>
                            <input type="text" class="form-control" id="namaLapangan" name="namaLapangan" required>
                        </div>
                        <div class="form-group">
                            <label for="waktu_mulai">Waktu Mulai</label>
                            <input type="datetime-local" class="form-control" id="waktu_mulai" name="waktuMulai"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="waktu_selesai">Waktu Selesai</label>
                            <input type="datetime-local" class="form-control" id="waktu_selesai" name="waktuSelesai"
                                required onchange="calculatePrice()">
                        </div>
                        <div class="form-group">
                            <label for="hargaTotal">Total Harga</label>
                            <input type="number" class="form-control" id="total_harga" name="hargaTotal" required
                                readonly>
                        </div>
                        <button type="submit" class="btn btn-primary">Update Booking</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Vendor JS Files -->
    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('datatables/datatables.min.js') }}"></script>
    <script src="assets/js/main.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Custom JS -->
    <script>
        const pricePerHour = 55000;

        function editBooking(booking) {
            $('#bookingId').val(booking.id);
            $('#namaPemesan').val(booking.namaPemesan);
            $('#namaLokasi').val(booking.lokasi.namaLokasi);
            $('#namaLapangan').val(booking.lapangan.namaLapangan);
            $('#waktu_mulai').val(booking.waktuMulai);
            $('#waktu_selesai').val(booking.waktuSelesai);
            $('#total_harga').val(booking.hargaTotal);
            $('#status').val(booking.status);
            $('#editBookingForm').attr('action', '/daftarbooking/' + booking.id); // Update URL with ID
            $('#editBookingModal').modal('show');
        }

        function calculatePrice() {
            const startTime = new Date($('#waktu_mulai').val());
            const endTime = new Date($('#waktu_selesai').val());
            const durationInHours = (endTime - startTime) / (1000 * 60 * 60);

            if (durationInHours > 0) {
                const totalPrice = durationInHours * pricePerHour;
                $('#total_harga').val(totalPrice);
            } else {
                $('#total_harga').val('');
            }
        }
    </script>

</body>

</html>
