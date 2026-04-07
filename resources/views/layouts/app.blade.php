<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="TemplateMo">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">

    <title>{{ $title ?? config('app.name') }}</title>

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css'>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.css">
    <link rel="stylesheet" href="assets/css/templatemo-lava.css?v=1">
    <link rel="stylesheet" href="assets/css/owl-carousel.css">

    @stack('style')
    <style>
        .d-1300-none {
            display: none !important;
        }

        @media (min-width: 1140px) {
            .d-1300-block {
                display: block !important;
            }

            .d-1300-none {
                display: none !important;
            }
        }

        .desktop-app-shell {
            position: relative;
            overflow: hidden;
        }

        .tugu-background {
            position: absolute;
            top: 0;
            right: 0;
            width: 100%;
            height: 540px;
            background-image: url('{{ asset('assets/images/tugu.png') }}');
            background-repeat: no-repeat;
            background-position: right;
            background-size: 550px;
            pointer-events: none;
            z-index: 0;
        }

        .desktop-app-shell>*:not(.tugu-background) {
            position: relative;
            z-index: 1;
        }

        .hero-row {
            margin-left: 0 !important;
            padding-left: clamp(1rem, 4vw, 4rem);
        }

        .hero-copy {
            margin-top: 15%;
            max-width: 620px;
        }

        .hero-brand {
            flex-wrap: wrap;
            gap: 0.75rem;
            margin-top: -1rem;
        }

        .hero-brand-logo {
            height: clamp(78px, 8vw, 140px);
            width: auto;
        }

        .hero-brand-mark {
            width: clamp(88px, 10vw, 200px);
            height: auto;
        }

        .hero-brand-text {
            margin: 0;
            line-height: 1;
            font-weight: bold;
            font-size: clamp(2.4rem, 4vw, 4rem);
            word-break: break-word;
        }

        .hero-title {
            line-height: 1.15 !important;
            font-size: clamp(2.6rem, 4.2vw, 4rem) !important;
        }

        @media (min-width: 1140px) and (max-width: 1439.98px) {
            .tugu-background {
                background-size: 470px;
                height: 500px;
            }

            .hero-copy {
                margin-top: 11%;
            }
        }

        @media (min-width: 1440px) {
            .hero-row {
                margin-left: -8rem !important;
                padding-left: 0;
            }

            .hero-copy {
                margin-top: 20% !important;
                max-width: none;
            }

            .hero-brand {
                margin-top: -2.5rem;
            }

            .hero-brand-logo {
                height: 140px;
            }

            .hero-brand-mark {
                width: 200px;
            }

            .hero-brand-text {
                font-size: 4rem;
            }

            .hero-title {
                line-height: 3.5rem !important;
                font-size: 52px !important;
            }

            .tugu-background {
                background-size: 550px;
                height: 540px;
            }
        }
    </style>

</head>

<body>
    <!-- ***** Preloader Start ***** -->
    <div id="preloader">
        <div class="jumper">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>
    <!-- ***** Preloader End ***** -->

    <div class="desktop-app-shell d-none d-1300-block">
        <div class="tugu-background"></div>
        <div class="welcome-area" id="welcome">

            <div class="header-text">
                <div class="container">
                    <div class="row hero-row">
                        <div class="left-text col-lg-6 col-md-12 col-sm-12 col-xs-12 hero-copy">
                            <div class="d-flex align-items-center mb-4 hero-brand">
                                <img id="logoTapin" src="{{ asset('assets/images/tapin.svg') }}" alt="Logo Tapin" data-scroll-reveal="enter left move 30px over 0.4s after 0.4s"
                                    class="hero-brand-logo">

                                <img id="logoSadata" src="{{ asset('assets/images/sadata2.svg') }}" alt="Logo Sadata" data-scroll-reveal="enter left move 30px over 0.4s after 0.4s"
                                    class="hero-brand-logo">
                            </div>

                            <div class="mb-5">&nbsp;</div>
                            <div class="mb-5">&nbsp;</div>
                            <h1 data-scroll-reveal="enter left move 30px over 0.4s after 0.4s" class="hero-title">SATU DATA
                                <em data-scroll-reveal="enter top move 30px over 0.5s after 0.4s">Kabupaten Tapin</em>
                            </h1>

                            <p data-scroll-reveal="enter top move 30px over 0.4s after 0.4s">
                                Platform integrasi data pemerintah daerah untuk menghadirkan data yang
                                akurat, terpadu, dan transparan sebagai dasar pengambilan kebijakan
                                serta peningkatan pelayanan publik.
                            </p>

                            <div data-scroll-reveal="enter top move 30px over 0.4s after 0.4s">
                                <a href="#portal" class="main-button-slider">Selengkapnya</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="d-none d-md-block d-1300-none">
        <div style="width: 100%; max-width: 720px; margin: 0 auto; padding: 2rem 1rem 1rem;">
            <img src="{{ asset('assets/images/landing-mobile.png') }}" class="img-fluid d-block mx-auto" alt="Landing Tablet">
        </div>
    </div>
    <div class="d-block d-xl-none">
        <div style="background-color: #f6ff00; width: 100%; max-width: 400px; margin: 0 auto;">
            <img src="{{ asset('assets/images/landing-mobile.png') }}" class="img-fluid d-block" alt="Tugu">
        </div>
    </div>

    <!-- ***** Welcome Area End ***** -->

    <!-- ***** Features Big Item Start ***** -->
    <section class="section" id="portal">
        {{ $slot }}
    </section>
    <!-- ***** Features Big Item End ***** -->

    <div class="left-image-decor"></div>

    <!-- ***** Features Big Item Start ***** -->
    <section class="section" id="promotion">
        <div class="container">
            <div class="row">
                <div class="left-image col-lg-5 col-md-12 col-sm-12 mobile-bottom-fix-big" data-scroll-reveal="enter left move 30px over 0.6s after 0.4s">
                    <img src="{{ asset('assets/images/mengapa-sadata.svg') }}" class="rounded img-fluid d-block mx-auto" alt="App">
                </div>
                <div class="right-text offset-lg-1 col-lg-6 col-md-12 col-sm-12 mobile-bottom-fix">
                    <ul>
                        <li data-scroll-reveal="enter right move 30px over 0.6s after 0.4s">
                            <img src="assets/images/about-icon-01.png" alt="">
                            <div class="text">
                                <h4>Peningkatan Kualitas Kebijakan</h4>
                                <p>Keputusan Bupati dan dinas didasarkan pada data yang akurat untuk menghasilkan kebijakan yang lebih tepat sasaran.</p>
                            </div>
                        </li>

                        <li data-scroll-reveal="enter right move 30px over 0.6s after 0.6s">
                            <img src="assets/images/about-icon-02.png" alt="">
                            <div class="text">
                                <h4>Transparansi & Akuntabilitas</h4>
                                <p>Memudahkan publik mengakses data pemerintah dan memantau setiap keputusan secara jelas dan akuntabel.</p>
                            </div>
                        </li>

                        <li data-scroll-reveal="enter right move 30px over 0.6s after 0.8s">
                            <img src="assets/images/about-icon-03.png" alt="">
                            <div class="text">
                                <h4>Efisiensi Data</h4>
                                <p>Menghindari duplikasi data antar-SKPD sehingga laporan lebih terorganisir dan efisien.</p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- ***** Features Big Item End ***** -->

    <!-- ***** Footer Start ***** -->
    <footer class="mt-0 py-5" style="background: linear-gradient(135deg, #d97f0a, #e64b4b); color: #fff;">
        <div class="container">
            <div class="row text-center">
                <div class="col">
                    <p class="mb-2 text-white" style="font-size: 0.95rem;">
                        &commat; 2026
                        <span id="admin" style="font-weight: 500;">Developed</span> by
                        <a rel="nofollow" href="http://diskominfo.profile.tapinkab.go.id/" style="color:#f6ff00; text-decoration: none;"
                            onmouseover="this.style.textDecoration='underline';" onmouseout="this.style.textDecoration='none';">
                            Dinas Komunikasi dan Informatika Kab. Tapin
                        </a>
                    </p>
                    <div style="border-bottom: 1px solid rgba(250,250,250,0.3); margin: 0 auto 20px; max-width: 200px;"></div>
                </div>
            </div>
        </div>
    </footer>

    <!-- jQuery -->
    <script src="assets/js/jquery-2.1.0.min.js"></script>

    <!-- Bootstrap -->
    <script src="assets/js/popper.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>

    <!-- Plugins -->
    <script src="assets/js/owl-carousel.js"></script>
    <script src="assets/js/scrollreveal.min.js"></script>
    {{-- <script src="https://unpkg.com/scrollreveal"></script> --}}

    <script src="assets/js/waypoints.min.js"></script>
    <script src="assets/js/jquery.counterup.min.js"></script>
    <script src="assets/js/imgfix.min.js"></script>
    <script src="assets/js/sweetalert2.js"></script>
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
    <!-- Global Init -->
    <script src="assets/js/custom.js"></script>

    <script>
        setTimeout(() => {
            document.getElementById('portal').scrollIntoView({
                behavior: 'smooth'
            });
        }, 1000);
    </script>

    <script>
        $(document).ready(function() {
            const name = 'admin';

            $('#admin').on('click', function(event) {
                event.preventDefault();

                Swal.fire({
                    title: "Sst.. Passwordnya?",
                    input: "password",
                    showCancelButton: true,
                    confirmButtonText: "Login",
                    showLoaderOnConfirm: true,
                    preConfirm: async (password) => {

                        try {
                            const response = await $.ajax({
                                url: '/login',
                                method: 'POST',
                                data: {
                                    name: name,
                                    password: password,
                                    _token: $('meta[name="csrf-token"]').attr('content')
                                },
                                dataType: 'json'
                            });

                            if (response.success) {
                                Swal.fire({
                                    title: 'Berhasil!',
                                    icon: 'success'
                                }).then(() => {
                                    window.location.href = '/admin';
                                });
                            } else {
                                Swal.showValidationMessage(`Password Salah!`);
                            }
                        } catch (error) {
                            Swal.showValidationMessage(`Request failed: ${error}`);
                        }
                    },
                    allowOutsideClick: () => !Swal.isLoading()
                });
            });
        });
    </script>


</body>

</html>
