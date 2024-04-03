<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <link rel="icon" type="image/x-icon" href="./img/logo.png" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dm Me</title>
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css"
    rel="stylesheet"
    integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx"
    crossorigin="anonymous"
  />
</head>
<body class="bg-info d-flex justify-content-center align-items-center vh-100">
<?php
session_start();
$us = $_SESSION["usuario"];
if ($us == "") {
    header("Location: index.html");
    exit; // Asegurarse de salir después de redirigir
}

?>


  <div
    class="bg-white p-5 rounded-5 text-secondary shadow"
    style="width: 25rem"
  >
    <div class="d-flex justify-content-center">
      <img
        src="./img/logo.png"
        alt="login-icon"
        style="height: 7rem"
      />
    </div>
    <div class="text-center fs-1 fw-bold">Registro</div>
    <form id="registroForm" action="crear.php" method="POST">
      <div class="input-group mt-4">
        <div class="input-group-text bg-info">
          <img
            src="./assets/username-icon.svg"
            alt="username-icon"
            style="height: 1rem"
          />
        </div>
        <input
          id="nombre"
          class="form-control bg-light"
          type="text"
          name="nombre"
          placeholder="Nombre completo"
          required/>
      </div>
      <div class="input-group mt-1">
        <div class="input-group-text bg-info">
          <img
            src="./assets/arroba-svgrepo-com.svg"
            alt="username-icon"
            style="height: 1rem"
            required/>
        </div>
        <input
          id="usuario"
          class="form-control bg-light"
          type="text"
          name="usuario"
          placeholder="Usuario"
          required/>
      </div>
      <div class="input-group mt-1">
        <div class="input-group-text bg-info">
          <img
            src="./assets/password-icon.svg"
            alt="password-icon"
            style="height: 1rem"
          />
        </div>
        <input
          id="password"
          class="form-control bg-light"
          type="password"
          name="password"
          placeholder="Contraseña"
          required/>
      </div>
      <div class="input-group mt-1">
        <div class="input-group-text bg-info">
          <img
            src="./assets/user-question.svg"
            alt="Rol"
            style="height: 1rem"
          />
        </div>
        <select class="form-select" name="rol" aria-label="Default select example" required>
        <option selected>Selecciona uno</option>
        <option value="administrador">Admin</option>
        <option value="usuario">User</option>
      </select>
      </div>
      <button id="crearCuentaBtn" class="btn btn-info text-white w-100 mt-4 fw-semibold shadow-sm">Crear Cuenta</button>
    </form>

  </div>

  <!-- Script para manejar el evento de clic en el botón "Crear Cuenta" -->
  <script>
    document.getElementById('crearCuentaBtn').addEventListener('click', async function(event) {
      // Evitar que el formulario se envíe automáticamente
      event.preventDefault();

      // Enviar el formulario al archivo PHP
      document.getElementById('registroForm').submit();
    });
  </script>
</body>
</html>
