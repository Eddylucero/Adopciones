<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Restablecer Contraseña | Adopciones</title>

  {{-- Spike CSS --}}
  <link rel="stylesheet" href="{{ asset('spike/src/assets/css/styles.min.css') }}">

  {{-- Font Awesome --}}
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  {{-- SweetAlert2 --}}
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  {{-- jQuery y jQuery Validate --}}
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>

  <style>
    .error {
      color: red;
      font-family: 'Montserrat';
    }

    .form-control.error {
      border: 1px solid red;
    }

    body {
      background-color: #fff8f5;
    }

    .card {
      border-radius: 16px;
    }

    .btn-primary {
      background-color: #ffb84d;
      border: none;
      font-weight: bold;
    }

    .btn-primary:hover {
      background-color: #ffa31a;
    }
  </style>
</head>

<body>
  <div class="page-wrapper min-vh-100 d-flex align-items-center justify-content-center">
    <div class="card shadow p-4" style="width: 460px;">
      <div class="card-body">
        <div class="text-center mb-4">
          <img src="{{ asset('spike/src/assets/images/logos/logo.svg') }}" width="100" alt="Logo">
          <h4 class="mt-3 fw-bold text-dark">Restablecer Contraseña</h4>
          <p class="text-muted">Ingresa tu nueva contraseña para continuar</p>
        </div>

        {{-- SweetAlert para mensajes --}}
        @if(session('success'))
          <script>
            Swal.fire({
              icon: 'success',
              title: '¡Listo!',
              text: '{{ session('success') }}',
              confirmButtonColor: '#ffb84d'
            });
          </script>
        @endif

        @if(session('error'))
          <script>
            Swal.fire({
              icon: 'error',
              title: 'Error',
              text: '{{ session('error') }}',
              confirmButtonColor: '#ffb84d'
            });
          </script>
        @endif

        {{-- Formulario --}}
        <form id="NuevaForm" method="POST" action="{{ route('password.update') }}">
          @csrf
          <input type="hidden" name="token" value="{{ $token ?? '' }}">

          <div class="mb-3">
            <label class="form-label">
              <i class="fa-solid fa-envelope me-2 text-warning"></i>Correo electrónico
            </label>
            <input type="email" name="email" class="form-control" placeholder="usuario@correo.com" required>
          </div>

          <div class="mb-3">
            <label class="form-label">
              <i class="fa-solid fa-lock me-2 text-warning"></i>Nueva contraseña
            </label>
            <input type="password" name="password" id="password" class="form-control" placeholder="Nueva contraseña" required>
          </div>

          <div class="mb-4">
            <label class="form-label">
              <i class="fa-solid fa-lock me-2 text-warning"></i>Confirmar contraseña
            </label>
            <input type="password" name="password_confirmation" class="form-control" placeholder="Confirma la contraseña" required>
          </div>

          <button type="submit" class="btn btn-primary w-100 py-2 mb-3">
            <i class="fa-solid fa-rotate-right me-2"></i>Restablecer contraseña
          </button>

          <div class="text-center">
            <a href="{{ route('login') }}" class="text-primary fw-bold">
              <i class="fa-solid fa-arrow-left me-1"></i> Volver al inicio de sesión
            </a>
          </div>
        </form>
      </div>
    </div>
  </div>

  {{-- Script de validación --}}
  <script>
    $("#NuevaForm").validate({
      rules: {
        email: {
          required: true,
          email: true
        },
        password: {
          required: true,
          minlength: 6
        },
        password_confirmation: {
          required: true,
          equalTo: "#password"
        }
      },
      messages: {
        email: {
          required: "El correo es obligatorio",
          email: "Ingrese un correo válido"
        },
        password: {
          required: "La nueva contraseña es obligatoria",
          minlength: "Debe tener al menos 6 caracteres"
        },
        password_confirmation: {
          required: "Debe confirmar la contraseña",
          equalTo: "Las contraseñas no coinciden"
        }
      },
      submitHandler: function(form) {
        Swal.fire({
          title: 'Actualizando contraseña...',
          text: 'Por favor espera unos segundos',
          icon: 'info',
          showConfirmButton: false,
          allowOutsideClick: false
        });
        form.submit();
      }
    });
  </script>
</body>
</html>
