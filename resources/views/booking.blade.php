<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Sewa Lapangan Badminton</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  
  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="../assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="../assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="../assets/css/style.css" rel="stylesheet">

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
                    <div class="card-body">
                        <table id="table_id" class="dataTable table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Lapangan</th>
                                    <th>Harga Lapangan</th>
                                    <th>Lokasi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($booking as $lok)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $lok->namaLapangan }}</td>
                                        <td>{{ $lok->hargaLapangan }}</td>
                                        <td>{{ $lok->lokasi->namaLokasi }}</td>
                                        <td>
                                            <button type="button" class="btn btn-info btn-sm"
                                                onclick="openBookingModal('{{ $lok->id }}', '{{ $lok->namaLapangan }}')">Pesan
                                                Lapangan</button>
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

    <!-- Booking Modal -->
    <div class="modal fade" id="bookingModal" tabindex="-1" role="dialog" aria-labelledby="bookingModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="bookingModalLabel">Pesan Lapangan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="bookingForm" method="POST" action="{{ route('bookings.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="nama_pemesan">Nama Pemesan:</label>
                            <input type="text" class="form-control" id="nama_pemesan" name="namaPemesan" required>
                        </div>
                        <div class="form-group">
                            <label for="no_hp">No HP:</label>
                            <input type="text" class="form-control" id="no_hp" name="noHp" required>
                        </div>
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
                            <label for="lokasi">Lapangan:</label>
                            <select class="form-control" id="lokasi" name="lapangan">
                                @foreach ($lapangan as $lok)
                                    <option value="{{ $lok->id }}">{{ $lok->namaLapangan }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="waktu_mulai">Waktu Mulai:</label>
                            <input type="datetime-local" class="form-control" id="waktu_mulai" name="waktuMulai"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="waktu_selesai">Waktu Selesai:</label>
                            <input type="datetime-local" class="form-control" id="waktu_selesai" name="waktuSelesai"
                                required onchange="calculatePrice()">
                        </div>
                        <div class="form-group">
                            <label for="total_harga">Total Harga:</label>
                            <input type="text" class="form-control" id="total_harga" name="hargaTotal" readonly>
                        </div>
                        <input type="hidden" id="lapangan_id" name="lapangan_id">
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="submitBooking()">Submit</button>
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

        function openBookingModal(lapanganId, namaLapangan) {
            $('#lapangan_id').val(lapanganId);
            $('#bookingModalLabel').text('Pesan Lapangan: ' + namaLapangan);
            $('#bookingModal').modal('show');
        }

        function calculatePrice() {
            const startTime = new Date($('#waktu_mulai').val());
            const endTime = new Date($('#waktu_selesai').val());
            const durationInHours = (endTime - startTime) / (1000 * 60 * 60);

            if (durationInHours > 0) {
                const totalPrice = durationInHours * pricePerHour;
                $('#total_harga').val(totalPrice); // Gunakan nilai numerik
            } else {
                $('#total_harga').val('');
            }
        }


        function submitBooking() {
            $('#bookingForm').submit();
        }
    </script>
</body>

</html>
