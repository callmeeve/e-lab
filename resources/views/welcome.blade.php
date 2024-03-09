<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>E-Lab Poliwangi</title>
    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('img/poliwangi.png') }}" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('vendor/css/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('vendor/css/theme-default.css') }}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
</head>

<body>
    <!-- Responsive navbar-->
    <nav class="navbar navbar-expand-lg navbar-white bg-white">
        <div class="container px-5">
            <a class="navbar-brand text-dark fw-bold" href="#!">E-Lab Poliwangi</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link text-dark" href="{{route('login')}}">Login</a></li>
                    <li class="nav-item"><a class="nav-link text-dark" href="{{route('mahasiswa.registerAkun')}}">Register</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Header-->
    <header class="bg-dark py-5">
        <div class="container px-5">
            <div class="row gx-5 justify-content-center">
                <div class="col-lg-6">
                    <div class="text-center my-5">
                        <h1 class="display-5 fw-bolder text-white mb-2">Temukan Peminjaman Alat Lab Poliwangi</h1>
                        <p class="lead text-white-50 mb-4">Dapatkan pinjaman alat laboratorium berkualitas tinggi untuk
                            kebutuhan eksperimen dan penelitian Anda dengan mudah.</p>
                        <div class="d-grid gap-3 d-sm-flex justify-content-sm-center">
                            <a class="btn btn-primary btn-lg px-4 me-sm-3" href="{{route('login')}}">Mulai Sekarang</a>
                            <a class="btn btn-outline-light btn-lg px-4" href="{{route('mahasiswa.registerAkun')}}">Pelajari Lebih Lanjut</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <section class="py-5 border-bottom" id="features">
        <div class="container px-5 my-5">
            <div class="row gx-5">
                <div class="col-lg-4 mb-5 mb-lg-0">
                    <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i
                            class="bi bi-collection"></i></div>
                    <h2 class="h4 fw-bold text-dark">Pilihan Alat Lab yang Luas</h2>
                    <p>Temukan berbagai macam peralatan laboratorium berkualitas tinggi yang sesuai dengan kebutuhan
                        eksperimen dan penelitian Anda di Poliwangi.</p>
                </div>
                <div class="col-lg-4 mb-5 mb-lg-0">
                    <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-building"></i>
                    </div>
                    <h2 class="h4 fw-bold text-dark">Fasilitas Laboratorium Modern</h2>
                    <p>Manfaatkan fasilitas laboratorium terbaik dengan teknologi mutakhir untuk mendukung riset dan
                        eksperimen Anda di Poliwangi.</p>                
                </div>
                <div class="col-lg-4">
                    <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-toggles2"></i>
                    </div>
                    <h2 class="h4 fw-bold text-dark">Proses Peminjaman yang Mudah</h2>
                    <p>Nikmati proses peminjaman yang cepat dan mudah untuk alat laboratorium Poliwangi, sehingga Anda
                        bisa fokus pada riset dan eksperimen Anda.</p>
                </div>
            </div>
        </div>
    </section>
    <section class="py-lg-5">
        <div class="container">
            <div class="row">
                <div class="col-xl-10 offset-xl-1 col-md-12 col-12">
                    <div class="bg-primary py-5 px-5 px-xl-0 rounded-4 ">
                        <div class="row align-items-center">
                            <div class="offset-xl-1 col-xl-5 col-md-6 col-12">
                                <div>
                                    <h2 class="h1 text-white mb-3 fw-bold">Temukan layanan peminjaman alat lab di Poliwangi!</h2>
                                    <p class="text-white fs-5">Dengan pelayanan kami, pengadaan alat lab menjadi lebih mudah dan efisien!</p>
                                    <a class="btn btn-dark" href="{{route('login')}}">Mulai pinjam</a>
                                </div>
                            </div>
                            <div class="col-xl-6 col-md-6 col-12">
                                <div class="text-center">
                                    <img src="{{ asset('img/icons/gear.png') }}" alt="learning" class="img-fluid"
                                        width="200" height="200">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Footer-->
    <footer class="py-5 bg-white">
        <div class="container px-5">
            <p class="m-0 text-center text-dark">Copyright &copy; E-Lab Poliwangi 2024</p>
        </div>
    </footer>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>


</html>
