<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Lapangan</title>
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
    @include('navbar')
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
