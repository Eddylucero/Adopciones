<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Home - Adopciones</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('spike/src/assets/images/logos/favicon.png') }}" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/additional-methods.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/localization/messages_es.min.js"></script>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.1/css/dataTables.dataTables.min.css">
    <script src="https://cdn.datatables.net/2.3.1/js/dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/plug-ins/2.3.1/i18n/es-ES.json"></script>
    
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.2.3/css/buttons.dataTables.min.css">
    <script src="https://cdn.datatables.net/buttons/3.2.3/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.2.3/js/buttons.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.2.3/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.2.3/js/buttons.print.min.js"></script>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.5.4/css/fileinput.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.5.4/js/fileinput.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.5.4/js/locales/es.min.js"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <link href="https://fonts.googleapis.com/css?family=Montserrat:200,300,400,500,600,700,800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="{{ asset('pets/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('pets/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('pets/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('pets/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('pets/css/bootstrap-datepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('pets/css/jquery.timepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('pets/css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('pets/css/style.css') }}">
  </head>
  <body>

    <div class="wrap">
      <div class="container">
        <div class="row">
          <div class="col-md-6 d-flex align-items-center">
            <p class="mb-0 phone pl-md-2">
              <a href="#" class="mr-2"><span class="fa fa-phone mr-1"></span> +00 1234 567</a> 
              <a href="#"><span class="fa fa-paper-plane mr-1"></span> youremail@email.com</a>
            </p>
          </div>
          <div class="col-md-6 d-flex justify-content-md-end">
            <div class="social-media">
              <p class="mb-0 d-flex">
                <a href="#" class="d-flex align-items-center justify-content-center"><span class="fa fa-facebook"></span></a>
                <a href="#" class="d-flex align-items-center justify-content-center"><span class="fa fa-twitter"></span></a>
                <a href="#" class="d-flex align-items-center justify-content-center"><span class="fa fa-instagram"></span></a>
                <a href="#" class="d-flex align-items-center justify-content-center"><span class="fa fa-dribbble"></span></a>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
      <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}"><span class="flaticon-pawprint-1 mr-2"></span>Adopciones</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="fa fa-bars"></span> Menu
        </button>

        <div class="collapse navbar-collapse" id="ftco-nav">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item"><a href="{{ route('home') }}" class="nav-link">Inicio</a></li>

            @auth
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fa fa-user me-2"></i>{{ Auth::user()->name }}
                </a>
                <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                  <li>
                    <a class="dropdown-item" href="#" id="logout-button">
                      <i class="fa fa-sign-out-alt me-2"></i> Cerrar sesión
                    </a>
                  </li>
                </ul>
              </li>
            @endauth

            @guest
              <li class="nav-item"><a href="{{ route('login') }}" class="nav-link">Iniciar sesión</a></li>
            @endguest
        </ul>
        </div>
      </div>
    </nav>
    <div class="hero-wrap" style="background-image: url('{{ asset('pets/images/bg_1.jpg') }}'); background-size: cover; background-position: center; height: 400px;">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-center justify-content-center" data-scrollax-parent="true">
          <div class="col-md-11 ftco-animate text-center">

          </div>
        </div>
      </div>
    </div>

    <section class="ftco-section bg-light ftco-no-pt ftco-intro">
      <div class="container">
        @yield('content')
      </div>
    </section>

    <footer class="footer">
      <div class="container">
        <div class="row mt-5">
          <div class="col-md-12 text-center">
            <p class="copyright">
              Copyright &copy;<script>document.write(new Date().getFullYear());</script> 
              All rights reserved | Made with <i class="fa fa-heart" aria-hidden="true"></i> by 
              <a href="https://colorlib.com" target="_blank">Colorlib.com</a>
            </p>
          </div>
        </div>
      </div>
    </footer>

    <div id="ftco-loader" class="show fullscreen">
      <svg class="circular" width="48px" height="48px">
        <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/>
        <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/>
      </svg>
    </div>
    
    <script src="{{ asset('pets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('pets/js/jquery-migrate-3.0.1.min.js') }}"></script>
    <script src="{{ asset('pets/js/popper.min.js') }}"></script>
    <script src="{{ asset('pets/js/bootstrap.min.js') }}"></script> <script src="{{ asset('pets/js/jquery.easing.1.3.js') }}"></script>
    <script src="{{ asset('pets/js/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('pets/js/jquery.stellar.min.js') }}"></script>
    <script src="{{ asset('pets/js/jquery.animateNumber.min.js') }}"></script>
    <script src="{{ asset('pets/js/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('pets/js/jquery.timepicker.min.js') }}"></script>
    <script src="{{ asset('pets/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('pets/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('pets/js/scrollax.min.js') }}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
    <script src="{{ asset('pets/js/google-map.js') }}"></script>
    <script src="{{ asset('pets/js/main.js') }}"></script>

    <style>
        .error {
        color: red;
        font-family: 'Montserrat';
        }
        
        .form-control.error {
        border: 1px solid red;
        }
    </style>

    @if (session('success'))
    <script>
        Swal.fire({
            title: '¡ÉXITO!',
            text: '{{ session('success') }}',
            icon: 'success',
            confirmButtonText: 'OK'
        });
    </script>
    @endif

    @if (session('error'))
    <script>
        Swal.fire({
            title: '¡ERROR!',
            text: '{{ session('error') }}',
            icon: 'error',
            confirmButtonText: 'OK'
        });
    </script>
    @endif
    
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const logoutBtn = document.getElementById('logout-button');
        logoutBtn.addEventListener('click', function (e) {
            e.preventDefault();
            e.stopPropagation();

            Swal.fire({
                title: '¿Cerrar sesión?',
                text: "¿Seguro que deseas salir de la sesión?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, cerrar sesión',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = "{{ route('logout') }}";

                    const token = document.createElement('input');
                    token.type = 'hidden';
                    token.name = '_token';
                    token.value = "{{ csrf_token() }}";
                    form.appendChild(token);

                    document.body.appendChild(form);
                    form.submit();
                }
            });
        });
    });
    </script>
  </body>
</html>