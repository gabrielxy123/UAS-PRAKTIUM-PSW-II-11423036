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

  <div class="intro intro-carousel swiper position-relative">
    <div class="swiper-wrapper">
      <div class="swiper-slide carousel-item-a intro-item bg-image" style="background-image: url(../assets/img/download.jpeg)">
        <div class="overlay overlay-a"></div>
        <div class="intro-content display-table">
          <div class="table-cell">
            <div class="container">
              <div class="row">
                <div class="col-lg-8">
                  <div class="intro-body">
                    <p class="intro-title-top">Badminton Jaya</p>
                    <h1 class="intro-title mb-4"><span class="color-b">Kurangi berat badanmu dengan bermain badminton</span></h1>
                    <p class="intro-subtitle intro-price">
                      <a href="/booking"><span class="price-a">Booking Disini</span></a>
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="swiper-slide carousel-item-a intro-item bg-image" style="background-image: url(../assets/img/ginting.jpeg)">
        <div class="overlay overlay-a"></div>
        <div class="intro-content display-table">
          <div class="table-cell">
            <div class="container">
              <div class="row">
                <div class="col-lg-8">
                  <div class="intro-body">
                    <p class="intro-title-top">Badminton Jaya</p>
                    <h1 class="intro-title mb-4"><span class="color-b">Kurangi berat badanmu dengan bermain badminton</span></h1>
                    <p class="intro-subtitle intro-price">
                      <a href="/booking"><span class="price-a">Booking Disini</span></a>
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="swiper-pagination"></div>
  </div><!-- End Intro Section -->

  <main id="main">
  </main>
  
  <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="../assets/vendor/php-email-form/validate.js"></script>
  <!-- Template Main JS File -->
  <script src="../assets/js/main.js"></script>
  @include('layanan')
</body>

</html>
