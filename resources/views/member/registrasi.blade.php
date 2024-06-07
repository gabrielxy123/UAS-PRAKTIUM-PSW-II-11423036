<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Sewa Lapangan Badminton</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="../assets/img/favicon.png" rel="icon">
    <link href="../assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="../assets/vendor/animate.css/animate.min.css" rel="stylesheet">
    <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    
    <!-- Template Main CSS File -->
    <link href="../assets/css/style.css" rel="stylesheet">
    <style>
        .vh-100 {
            min-height: 150vh;
        }
    </style>
</head>

<body>
    <section class="vh-100" style="background-color: #508bfc;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card shadow-2-strong" style="border-radius: 1rem;">
                        <div class="card-body p-5 text-center">

                            <h3 class="mb-5">Registrasi Member</h3>

                            <form action="{{ route('registermemb') }}" method="POST">
                                @csrf
                                @if (Session::has('error_message'))
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <strong>Error: </strong> {{ Session::get('error_message') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
                                <div data-mdb-input-init class="form-outline mb-4">
                                    <input type="text" id="nama" name="nama" class="form-control form-control-lg" />
                                    <label class="form-label" for="nama">Nama</label>
                                </div>
                                @error('nama')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                <div data-mdb-input-init class="form-outline mb-4">
                                    <input type="text" id="noHp" name="noHp" class="form-control form-control-lg" />
                                    <label class="form-label" for="noHp">No Handphone</label>
                                </div>
                                @error('noHp')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                <div data-mdb-input-init class="form-outline mb-4">
                                    <input type="text" id="username" name="username" class="form-control form-control-lg" />
                                    <label class="form-label" for="username">Username</label>
                                </div>
                                @error('username')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                <div data-mdb-input-init class="form-outline mb-4">
                                    <input type="password" id="password" name="password" class="form-control form-control-lg" />
                                    <label class="form-label" for="password">Password</label>
                                </div>
                                @error('password')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                <button data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-lg btn-block" type="submit">Register</button>
                            </form>
                            <br>
                            <hr class="my-4">
                            <a href="/">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Vendor JS Files -->
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>
