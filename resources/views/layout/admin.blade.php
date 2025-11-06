<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sistema de Administración - Refugio</title>
  
  <link rel="shortcut icon" type="image/png" href="{{ asset('spike/src/assets/images/logos/favicon.png') }}" />
  <link rel="stylesheet" href="{{ asset('spike/src/assets/css/styles.min.css') }}">

  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/additional-methods.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/localization/messages_es.min.js"></script>
    
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> 
    
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
</head>

<body>
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">

    <aside class="left-sidebar">
      <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
          <a href="#" class="text-nowrap logo-img">
            <img src="{{ asset('spike/src/assets/images/logos/logo.svg') }}" alt="" />
          </a>
          <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
            <i class="ti ti-x fs-8"></i>
          </div>
        </div>
        
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
          <ul id="sidebarnav">
            <li class="nav-small-cap">
              <iconify-icon icon="solar:menu-dots-linear" class="nav-small-cap-icon fs-4"></iconify-icon>
              <span class="hide-menu">Gestión</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link primary-hover-bg" href="{{ route('dashboard.index') }}" aria-expanded="false">
                <iconify-icon icon="dashicons:dashboard"></iconify-icon>
                <span class="hide-menu">Dashboard</span>
              </a>
            </li>

            <li class="sidebar-item">
              <a class="sidebar-link primary-hover-bg" href="{{ route('mascotas.index') }}" aria-expanded="false">
                <iconify-icon icon="solar:paw-line-duotone"></iconify-icon>
                <span class="hide-menu">Mascotas</span>
              </a>
            </li>
            
            <li class="sidebar-item">
              <a class="sidebar-link primary-hover-bg" href="{{ route('personas.index') }}" aria-expanded="false">
                <iconify-icon icon="solar:users-group-rounded-line-duotone"></iconify-icon>
                <span class="hide-menu">Personas</span>
              </a>
            </li>
            
            <li class="sidebar-item">
              <a class="sidebar-link primary-hover-bg" href="{{ route('adopciones.index') }}" aria-expanded="false">
                <iconify-icon icon="solar:heart-line-duotone"></iconify-icon>
                <span class="hide-menu">Adopción</span>
              </a>
            </li>
          </ul>
        </nav>
        </div>
      </aside>
    <div class="body-wrapper">
      <div class="body-wrapper-inner">
        <div class="container-fluid">
          <header class="app-header">
            <nav class="navbar navbar-expand-lg navbar-light">
              <ul class="navbar-nav">
                <li class="nav-item d-block d-xl-none">
                  <a class="nav-link sidebartoggler " id="headerCollapse" href="javascript:void(0)">
                    <i class="ti ti-menu-2"></i>
                  </a>
                </li>
              </ul>
              <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
                <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
                  <li class="nav-item dropdown">
                    <a class="nav-link" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown"
                      aria-expanded="false">
                      <img src="{{ asset('spike/src/assets/images/profile/user1.jpg') }}" alt="" width="35" height="35"
                        class="rounded-circle">
                    </a>
                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                      <div class="message-body">
                        <a href="javascript:void(0)" id="logout-button"
                          class="btn btn-outline-primary mx-3 mt-2 d-block">Cerrar Sesión</a>
                        </div>
                    </div>
                  </li>
                </ul>
              </div>
            </nav>
          </header>
          <div class="container-fluid py-4">
            @yield('content')
          </div>
          
            <footer class="text-center mt-5" style="font-size: 14px; color: #888;">
            <div class="py-3">
                <span style="opacity: 0.8;">
                <i class="text-warning me-1"></i> Sistema de Administración - Refugio de Mascotas
                </span>
                <br>
                <small style="font-size: 12px; opacity: 0.6;">&copy; {{ date('Y') }} Todos los derechos reservados</small>
            </div>
            </footer>
        </div>
      </div>
    </div>
  </div>
  
  <script src="{{ asset('spike/src/assets/js/sidebarmenu.js') }}"></script>
  <script src="{{ asset('spike/src/assets/js/app.min.js') }}"></script>
  <script src="{{ asset('spike/src/assets/libs/simplebar/dist/simplebar.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>

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

            if (logoutBtn) {
                logoutBtn.addEventListener('click', function (e) {
                    e.preventDefault();
                    e.stopPropagation();

                    Swal.fire({
                        title: '¿Cerrar sesión?',
                        text: "¿Seguro que deseas salir del sistema de administración?",
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
                            token.value = '{{ csrf_token() }}'; 
                            form.appendChild(token);

                            document.body.appendChild(form);
                            form.submit();
                        }
                    });
                });
            }
        });
    </script>
</body>

</html>