<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inicio de sesión</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
  <link rel="stylesheet" href="{{ asset('css/ADMINISTRADOR.CSS') }}">
  <link rel="shortcut icon" href="{{ asset('img/logo/icon.png')}}" type="image/x-icon">
</head>

<body>
  <section class="vh-100">
    <div class="container py-5 h-100">
      <div class="row d-flex align-items-center justify-content-center h-100">
        <div class="col-md-8 col-lg-7 col-xl-6 fade-in-1">
          <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.svg" class="img-fluid" alt="Phone image">
        </div>
        <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
          <div class="login-card p-4">

            <!-- Pills navs -->
            <ul class="nav nav-pills nav-justified mb-3" id="ex1" role="tablist">
              <li class="nav-item" role="presentation">
                <a class="nav-link active" id="tab-login" data-mdb-toggle="pill" href="#pills-login" role="tab" aria-controls="pills-login" aria-selected="true">Login</a>
              </li>
              <li class="nav-item" role="presentation">
                <a class="nav-link" id="tab-register" data-mdb-toggle="pill" href="#pills-register" role="tab" aria-controls="pills-register" aria-selected="false">Register</a>
              </li>
            </ul>
            <!-- Pills navs -->
            <div class="tab-content">
              <div class="tab-pane fade show active" id="pills-login" role="tabpanel" aria-labelledby="tab-login">
                <!-- Formulario de inicio de sesión -->

                <form action="{{ route('iniciarSesion') }}" method="POST">
                  @csrf

                  <div class="d-flex align-items-center mb-4 pb-1 fade-in-2">
                    <img src="{{ asset('img/logo/icon.png') }}" alt="Logo" class="logo-img me-3" style="width: 50px; height: 50px;">
                    <span class="h1 fw-bold mb-0 brand-title">Finca Al Día</span>
                  </div>

                  <h5 class="fw-normal mb-4 pb-3 fade-in-2" style="letter-spacing: 1px; color: #495057;">Inicia sesión en tu cuenta</h5>
                  <div class="form-floating mb-4 fade-in-3">
                    <input type="email" class="form-control form-control-lg" id="form2Example17" name="email" placeholder="correo@ejemplo.com" required>
                    <label for="form2Example17"><i class="fas fa-envelope me-2"></i>Correo electrónico</label>
                  </div>
                  <div class="form-floating mb-4 fade-in-3">
                    <input type="password" class="form-control form-control-lg" id="password" name="password" placeholder="Contraseña" required>
                    <label for="password"><i class="fas fa-lock me-2"></i>Contraseña</label>
                  </div>
                  <div class="pt-1 mb-4 fade-in-4">
                    <!-- En el botón de login -->
                    <button class="btn btn-primary-custom w-100" type="submit">
                      <span class="btn-text"><i class="fas fa-sign-in-alt me-2"></i>Iniciar Sesión</span>
                      <span class="btn-spinner d-none"><i class="fas fa-spinner fa-spin me-2"></i>Iniciando sesión...</span>
                    </button>
                  </div>
                  <div class="text-center mb-4 fade-in-4">
                    <a class="small text-muted text-decoration-none" href="#!"><i class="fas fa-key me-1"></i>¿Olvidaste tu contraseña?</a>
                  </div>
                  <p class="mb-4 pb-lg-2 text-center fade-in-4" style="color: #393f81;">
                    ¿No tienes una cuenta?
                    <a href="#!" class="text-decoration-none" style="color: #393f81;"><strong>Regístrate aquí</strong></a>
                  </p>
                  <div class="text-center fade-in-4">
                    <a href="#!" class="small text-muted text-decoration-none me-3"><i class="fas fa-file-contract me-1"></i>Términos de uso</a>
                    <a href="#!" class="small text-muted text-decoration-none"><i class="fas fa-shield-alt me-1"></i>Política de privacidad</a>
                  </div>
                </form>
              </div>

              <div class="tab-pane fade" id="pills-register" role="tabpanel" aria-labelledby="tab-register">
                <!-- Formulario de registro -->
                <form method="POST" action="">
                  @csrf
                  <div class="d-flex align-items-center mb-4 pb-1 fade-in-2">
                    <img src="{{ asset('img/logo/icon.png') }}" alt="Logo" class="logo-img me-3" style="width: 50px; height: 50px;">
                    <span class="h1 fw-bold mb-0 brand-title">Finca Al Día</span>
                  </div>

                  <h5 class="fw-normal mb-4 pb-3 fade-in-2" style="letter-spacing: 1px; color: #495057;">Crea una cuenta nueva</h5>

                  <div class="row mb-4 fade-in-3">
                    <div class="col-md-6">
                      <div class="form-floating">
                        <select class="form-select form-select" id="tipo_usuario" name="tipo_usuario" required>
                          <option value="" disabled selected>Selecciona un tipo de usuario</option>
                          <option value="admin">Administrador</option>
                          <option value="user">Usuario</option>
                        </select>
                        <label for="tipo_usuario"><i class="fas fa-user-tag me-2"></i>Tipo de Usuario</label>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-floating">
                        <input type="text" class="form-control form-control-lg" id="" name="nombre" required>
                        <label for="nombre"><i class="fas fa-user me-2"></i>Nombre</label>
                      </div>
                    </div>
                  </div>

                  <div class="form-floating mb-4 fade-in-3">
                    <input type="text" class="form-control form-control-lg" id="apellido" name="apellido" required>
                    <label for="apellido"><i class="fas fa-user me-2"></i>Apellido</label>
                  </div>

                  <div class="form-floating mb-4 fade-in-3">
                    <input type="text" class="form-control form-control-lg" id="direccion" name="direccion" required>
                    <label for="direccion"><i class="fas fa-location me-2"></i>Direccion</label>
                  </div>

                  <div class="row mb-4 fade-in-3">
                    <div class="col-md-6">
                      <div class="form-floating">
                        <input type="email" class="form-control form-control-lg" id="email" name="email" placeholder="correo@ejemplo.com" required>
                        <label for="email"><i class="fas fa-envelope me-2"></i>Correo electrónico</label>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-floating">
                        <input type="date" class="form-control form-control" id="fecha_nac" name="fecha_nac" required>
                        <label for="fecha_nac"><i class="fas fa-date me-2"></i>Fecha de Nacimiento</label>
                      </div>
                    </div>
                  </div>
                  <div class="pt-1 mb-4 fade-in-4">
                    <button class="btn btn-primary-custom btn-lg btn-block w-100" type="submit">
                      <i class="fas fa-sign-in-alt me-2"></i>Registrar
                    </button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.2/mdb.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.min.js" integrity="sha384-7qAoOXltbVP82dhxHAUje59V5r2YsVfBafyUDxEdApLPmcdhBPg1ERo0BZlK" crossorigin="anonymous"></script>

  <script>
    // Efecto de entrada suave para el formulario
    document.addEventListener('DOMContentLoaded', function() {
      // Agregar efecto de focus mejorado
      document.querySelectorAll('.form-control').forEach(input => {
        input.addEventListener('focus', function() {
          this.parentElement.style.transform = 'translateY(-2px)';
          this.parentElement.style.transition = 'transform 0.3s ease';
        });

        input.addEventListener('blur', function() {
          this.parentElement.style.transform = 'translateY(0)';
        });
      });

      // Efecto de loading en el botón
      document.querySelector('form').addEventListener('submit', function(e) {
        const button = document.querySelector('.btn-primary-custom');
        const originalText = button.innerHTML;

        button.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Iniciando sesión...';
        button.disabled = true;

        // Restaurar después de 3 segundos (quitar en producción)
        setTimeout(() => {
          button.innerHTML = originalText;
          button.disabled = false;
        }, 1000);
      });
    });

    document.addEventListener('DOMContentLoaded', function() {
      // ...existing code...

      document.querySelectorAll('form').forEach(form => {
        form.addEventListener('submit', function(e) {
          const button = form.querySelector('.btn-primary-custom');
          if (!button) return;
          const btnText = button.querySelector('.btn-text');
          const btnSpinner = button.querySelector('.btn-spinner');
          if (btnText && btnSpinner) {
            btnText.classList.add('d-none');
            btnSpinner.classList.remove('d-none');
          }
          button.disabled = true;
          // Restaurar después de 1 segundo (solo para pruebas)
          setTimeout(() => {
            if (btnText && btnSpinner) {
              btnText.classList.remove('d-none');
              btnSpinner.classList.add('d-none');
            }
            button.disabled = false;
          }, 1000);
        });
      });
    });
  </script>
</body>

</html>