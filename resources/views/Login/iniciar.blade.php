<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" type="image/png" href="{{ asset('spike/src/assets/images/logos/favicon.png') }}" />
  <title>Iniciar Sesión | Adopciones</title>

  <link rel="stylesheet" href="{{ asset('spike/src/assets/css/styles.min.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>

  <style>
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

    .error {
      color: red;
      font-family: 'Montserrat';
    }

    .form-control.error {
      border: 1px solid red;
    }

    #loading-overlay {
      display: none;
      position: fixed;
      top: 0;
      left: 0;
      width: 100vw;
      height: 100vh;
      background: rgba(0, 0, 0, 0.3);
      z-index: 9999;
      justify-content: center;
      align-items: center;
      opacity: 0;
      transition: opacity 0.3s ease;
    }

    #loading-overlay.d-flex {
      display: flex;
      opacity: 1;
    }

    .spinner {
      border: 8px solid #f3f3f3;
      border-top: 8px solid #ffb84d;
      border-radius: 50%;
      width: 80px;
      height: 80px;
      animation: spin 1s linear infinite;
    }

    @keyframes spin {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
    }
  </style>
</head>

<body>
  <div id="loading-overlay">
    <div class="spinner"></div>
  </div>

  <div class="page-wrapper min-vh-100 d-flex align-items-center justify-content-center">
    <div class="card shadow p-4" style="width: 420px;">
      <div class="card-body">
        <div class="text-center mb-4">
          <h4 class="mt-3 fw-bold text-dark">Iniciar Sesión</h4>
          <p class="text-muted">Bienvenido al sistema de adopciones</p>
        </div>

        @if(session('success'))
          <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if(session('error'))
          <div class="alert alert-danger">{{ session('error') }}</div>
          <script>
            $(document).ready(function() {
              $("#loading-overlay").removeClass("d-flex").fadeOut();
            });
          </script>
        @endif

        <form id="LoginForm" method="POST" action="{{ route('login.post') }}">
          @csrf

          <div class="mb-3">
            <label class="form-label"><i class="fa-solid fa-envelope me-2 text-warning"></i>Correo electrónico</label>
            <input type="email" name="email" class="form-control" placeholder="usuario@example.com">
          </div>

          <div class="mb-4">
            <label class="form-label"><i class="fa-solid fa-lock me-2 text-warning"></i>Contraseña</label>
            <input type="password" name="password" class="form-control" placeholder="Tu contraseña">
          </div>

          <button type="submit" class="btn btn-primary w-100 py-2">
            <i class="fa-solid fa-right-to-bracket me-2"></i>Ingresar
          </button>

          <div class="text-center mt-4">
            <p class="mb-0">¿No tienes cuenta?
              <a class="text-primary fw-bold" href="{{ route('register') }}">Regístrate aquí</a>
            </p>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script>
    $("#LoginForm").validate({
      rules: {
        email: { required: true, email: true },
        password: { required: true, minlength: 6 }
      },
      messages: {
        email: { required: "El correo es obligatorio", email: "Ingrese un correo válido" },
        password: { required: "La contraseña es obligatoria", minlength: "Debe tener al menos 6 caracteres" }
      },
      submitHandler: function(form) {
        $("#loading-overlay").addClass("d-flex").fadeIn();
        form.submit();
      }
    });
  </script>
</body>
</html>
