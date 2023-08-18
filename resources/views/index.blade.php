<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="author" content="">
    <link rel="icon" href="{{ asset('images/bg-logo.png') }}" type="image/x-icon">
    <title>
        Pemesanan Menu
    </title>


    <!-- Custom fonts for this template-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
        integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    {{-- <link href="{{ asset('css/all.min.css') }}" rel="stylesheet" type="text/css"> --}}
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">


    <!-- Custom styles for this template-->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/sb-admin-2.min.css') }}">
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/startbootstrap-sb-admin-2/4.1.4/css/sb-admin-2.css" integrity="sha512-gOfBez3ehpchNxj4TfBZfX1MDLKLRif67tFJNLQSpF13lXM1t9ffMNCbZfZNBfcN2/SaWvOf+7CvIHtQ0Nci2A==" crossorigin="anonymous" referrerpolicy="no-referrer" /> --}}

    <link rel="stylesheet" href="{{ asset('css/carousel.css') }}">
    <style>
        /* Smooth scrolling behavior */
        html {
            scroll-behavior: smooth;
        }

        #product {
            padding-top: 100px;
        }
    </style>
</head>

<body id="home" data-spy="scroll" data-target="#navbar" data-offset="50">

    <header>
        <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark" id="navbar">
            <div class="container">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"
                    aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <a class="navbar-brand mr-auto mt-2 mt-lg-0" href="#">Pemesanan Menu</a>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="#home">Home <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#product">Product</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#about">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#support">Support</a>
                        </li>
                        <li class="nav-item">
                            <a href="/login" class="btn btn-outline-info my-2 my-sm-0">Log In</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <main role="main">

        <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="1"></li>
                <li data-target="#myCarousel" data-slide-to="2"></li>
                <li data-target="#myCarousel" data-slide-to="3"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="first-slide" src="{{ asset('images/chef.png') }}" alt="Chef">
                    <div class="container">
                        <div class="carousel-caption text-right">
                            <h1>Chef.</h1>
                            <p>Seorang profesional di bidang kuliner yang memiliki keahlian dalam memasak makanan dan
                                menciptakan hidangan yang lezat dan menarik secara visual.</p>
                            <p><a class="btn btn-lg btn-primary" href="/login" role="button">Log In</a></p>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="second-slide" src="{{ asset('images/admin.png') }}" alt="Admin">
                    <div class="container">
                        <div class="carousel-caption text-right">
                            <h1>Admin.</h1>
                            <p>Singkatan dari administrator, yang merujuk pada seseorang yang bertanggung jawab untuk
                                mengelola dan mengawasi operasi dan kegiatan suatu organisasi, sistem, atau lingkungan
                                tertentu.</p>
                            <p><a class="btn btn-lg btn-primary" href="/" role="button">Log In</a></p>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="third-slide" src="{{ asset('images/kasir.png') }}" alt="Kasir">
                    <div class="container">
                        <div class="carousel-caption text-right">
                            <h1>Kasir.</h1>
                            <p>Seorang individu yang bertanggung jawab untuk menerima pembayaran dari pelanggan atas
                                produk atau layanan yang dibeli.</p>
                            <p><a class="btn btn-lg btn-primary" href="/" role="button">Log In</a></p>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="four-slide" src="{{ asset('images/waiter.png') }}" alt="Waiter">
                    <div class="container">
                        <div class="carousel-caption text-right">
                            <h1>Waiter.</h1>
                            <p>Seorang individu yang bekerja di industri perhotelan atau restoran dan bertanggung jawab
                                untuk memberikan pelayanan kepada tamu atau pelanggan.</p>
                            <p><a class="btn btn-lg btn-primary" href="/login" role="button">Log In</a></p>
                        </div>
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>


        <!-- Marketing messaging and featurettes
        ================================================== -->
        <!-- Wrap the rest of the page in another container to center all the content. -->

        <div class="container marketing">

            <!-- Three columns of text below the carousel -->
            <div class="row" id="product">
                <div class="col-lg-4">
                    <img class="rounded-circle" src="{{ asset('images/nasi-timbel.jpg') }}"
                        alt="Generic placeholder image" width="140" height="140">
                    <h2>Nasi Timbel</h2>
                    <p>Nasi Timbel hidangan Khas Sunda yang lezat dan kaya cita rasa. Disajikan dengan lauk seperti ikan
                        bakar / ayam goreng, tahu, tempe, serta sambal dan lalapan.</p>
                    <p><a class="btn btn-secondary" href="/login" role="button">Pesan Sekarang &raquo;</a></p>
                </div><!-- /.col-lg-4 -->
                <div class="col-lg-4">
                    <img class="rounded-circle" src="{{ asset('images/pepes-ikan.jpg') }}"
                        alt="Generic placeholder image" width="140" height="140">
                    <h2>Pepes Ikan</h2>
                    <p>Pepes Ikan hidangan tradisional Sunda yang terdiri dari ikan yang dibumbui dengan rempah khas
                        lalu dibungkus dengan daun pisan dan dibakar. Pepes Ikan disajikan dengan nasi putih dan sambal.
                    </p>
                    <p><a class="btn btn-secondary" href="#" role="button">Pesan Sekarang &raquo;</a></p>
                </div><!-- /.col-lg-4 -->
                <div class="col-lg-4">
                    <img class="rounded-circle" src="{{ asset('images/sayur-asem.jpg') }}"
                        alt="Generic placeholder image" width="140" height="140">
                    <h2>Sayur Asem</h2>
                    <p>Sayur Asem sangat terkenal di masakan Sunda. Memiliki cita rasa yang segar, asam dan sedikit
                        pedas. Disajikan dengan nasi hangat.</p>
                    <p><a class="btn btn-secondary" href="#" role="button">Pesan Sekarang &raquo;</a></p>
                </div><!-- /.col-lg-4 -->
            </div><!-- /.row -->


            <!-- START THE FEATURETTES -->

            <div class="row" id="about">
                <hr class="featurette-divider">

                <div class="row featurette">
                    <div class="col-md-7">
                        <h2 class="featurette-heading">Kemudahan Akses. <span class="text-muted">Ease of
                                Access.</span></h2>
                        <p class="lead">Aplikasi Pemesanan Menu menyediakan akses yang mudah dan nyaman bagi
                            pelanggan untuk menjelajahi berbagai menu, melihat pilihan makanan atau minuman, dan memesan
                            dengan cepat.</p>
                    </div>
                    <div class="col-md-5">
                        <img class="featurette-image img-fluid mx-auto" src="{{ asset('images/1.png') }}"
                            alt="Ease of Access">
                    </div>
                </div>

                <hr class="featurette-divider">

                <div class="row featurette">
                    <div class="col-md-7 order-md-2">
                        <h2 class="featurette-heading">Pilihan Menu yang Diversifikasi. <span
                                class="text-muted">Diversified Menu Options.</span></h2>
                        <p class="lead">Pelanggan dapat menelajahi menu lengkap, melihat deskripsi dan harga item,
                            dan memilih makanan atau minuman yang sesuai dengan preferensi dan kebutuhan mereka.</p>
                    </div>
                    <div class="col-md-5 order-md-1">
                        <img class="featurette-image img-fluid mx-auto" src="{{ asset('images/2.png') }}"
                            alt="Diversified Menu Options">
                    </div>
                </div>

                <hr class="featurette-divider">

                <div class="row featurette">
                    <div class="col-md-7">
                        <h2 class="featurette-heading">Pembayaran Aman dan Mudah. <span class="text-muted">Safe and
                                Easy Payment.</span></h2>
                        <p class="lead">Pelanggan dapat melakukan pembayaran langsung melalui aplikasi menggunakan
                            kartu kredit/debit, e-wallet, atau metode pembayaran digital lainnya.</p>
                    </div>
                    <div class="col-md-5">
                        <img class="featurette-image img-fluid mx-auto" src="{{ asset('images/3.png') }}"
                            alt="Safe and Easy Payment">
                    </div>
                </div>

                <hr class="featurette-divider">
            </div>


            <!-- /END THE FEATURETTES -->

        </div><!-- /.container -->


        <!-- FOOTER -->
        <footer class="container py-5" id="support">
            <div class="row">
                <div class="col-12 col-md">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="d-block mb-2">
                        <circle cx="12" cy="12" r="10"></circle>
                        <line x1="14.31" y1="8" x2="20.05" y2="17.94"></line>
                        <line x1="9.69" y1="8" x2="21.17" y2="8"></line>
                        <line x1="7.38" y1="12" x2="13.12" y2="2.06"></line>
                        <line x1="9.69" y1="16" x2="3.95" y2="6.06"></line>
                        <line x1="14.31" y1="16" x2="2.83" y2="16"></line>
                        <line x1="16.62" y1="12" x2="10.88" y2="21.94"></line>
                    </svg>
                    <small class="d-block mb-3 text-muted">&copy; Asep Saepudin 2023</small>
                </div>
                <div class="col-6 col-md">
                    <h5>Features</h5>
                    <ul class="list-unstyled text-small">
                        <li><a class="text-muted" href="#">Cool stuff</a></li>
                        <li><a class="text-muted" href="#">Random feature</a></li>
                        <li><a class="text-muted" href="#">Team feature</a></li>
                        <li><a class="text-muted" href="#">Stuff for developers</a></li>
                        <li><a class="text-muted" href="#">Another one</a></li>
                        <li><a class="text-muted" href="#">Last time</a></li>
                    </ul>
                </div>
                <div class="col-6 col-md">
                    <h5>Resources</h5>
                    <ul class="list-unstyled text-small">
                        <li><a class="text-muted" href="#">Resource</a></li>
                        <li><a class="text-muted" href="#">Resource name</a></li>
                        <li><a class="text-muted" href="#">Another resource</a></li>
                        <li><a class="text-muted" href="#">Final resource</a></li>
                    </ul>
                </div>
                <div class="col-6 col-md">
                    <h5>Resources</h5>
                    <ul class="list-unstyled text-small">
                        <li><a class="text-muted" href="#">Business</a></li>
                        <li><a class="text-muted" href="#">Education</a></li>
                        <li><a class="text-muted" href="#">Government</a></li>
                        <li><a class="text-muted" href="#">Gaming</a></li>
                    </ul>
                </div>
                <div class="col-6 col-md">
                    <h5>About</h5>
                    <ul class="list-unstyled text-small">
                        <li><a class="text-muted" href="#">Team</a></li>
                        <li><a class="text-muted" href="#">Locations</a></li>
                        <li><a class="text-muted" href="#">Privacy</a></li>
                        <li><a class="text-muted" href="#">Terms</a></li>
                    </ul>
                </div>
            </div>
        </footer>
    </main>

    <!-- Custom scripts for all pages-->
    {{-- <script src="{{ asset('js/sb-admin-2.min.js') }}"></script> --}}

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>
</body>

</html>
