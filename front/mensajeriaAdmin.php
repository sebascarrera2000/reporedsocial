<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mensajes</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <!-- Estilos personalizados -->
  <link rel="stylesheet" href="styles.css">
</head>
<body class="bg-light">
<?php
session_start();
$us = $_SESSION["usuario"];
if ($us == "") {
    header("Location: index.html");
    exit; // Asegurarse de salir después de redirigir
}

// Obtener el ID del usuario utilizando la API
$url = "http://localhost:3001/usuarios/$us";
$response = file_get_contents($url);
$usuario_data = json_decode($response, true);

// Verificar si se obtuvo la información del usuario correctamente
if ($usuario_data && isset($usuario_data[0]['id'])) {
    $usuario_id = $usuario_data[0]['id'];

    // Obtener mensajes del usuario utilizando su ID
    $url_mensajes = "http://localhost:3002/mensajes/$usuario_id";
    $response_mensajes = file_get_contents($url_mensajes);
    $mensajes = json_decode($response_mensajes, true);
} else {
    // Manejar el caso en el que no se pueda obtener el ID del usuario
    $usuario_id = null;
    $mensajes = null;
}
?>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <img src="./img/logo.png" alt="" style="width: 70px">
    <a class="navbar-brand" href="#">DM ME</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ml-auto">
      <li class="nav-item">
          <a class="nav-link" href="admin.php">Usuarios</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="mensajeriaAdmin.php">Mensajes</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="seguimientoAdmin.php">Seguidores</a>
        </li>
        <li class="nav-item">
        <?php echo "<a class='nav-link' href='logout.php'>Logout $us</a>" ;?>
        </li>
      </ul>
    </div>
  </nav>

    <div class="container py-4">
        <div class="row justify-content-center">
          <div class="col-md-8">
            <div class="card">
              <div class="card-header bg-primary text-white">
                <h5 class="m-0">Crear Mensaje</h5>
              </div>
              <div class="card-body">
                <form action="crear_mensajeAdmin.php" method="POST">
                  <div class="mb-3">
                  
                  </div>
                  <div class="mb-3">
                    <label for="contenido" class="form-label">Contenido del Mensaje</label>
                    <textarea class="form-control" id="contenido" name="contenido" rows="4" required></textarea>
                  </div>
                  <button type="submit" class="btn btn-primary">Enviar Mensaje</button>
                </form>
              </div>
            </div>
            <div class="card mt-4">
              <div class="card-header bg-success text-white">
                <h5 class="m-0">Tus Mensajes Recientes</h5>
              </div>
              <div class="card-body">
                <?php
                 if ($mensajes && is_array($mensajes)) {
                  // Mostrar los mensajes
                  foreach ($mensajes as $mensaje) {
                      echo '<div class="mb-3">';
                      echo '<div class="fw-bold"> Id Mensaje : ' . $mensaje['id'] . '</div>';
                      echo '<div> Mensajes: ' . $mensaje['contenido'] . '</div>';
                      echo '</div>';
                  }
              } else {
                  echo 'No se pudieron obtener los mensajes.';
              }
                ?>
              </div>
            </div>
          </div>
        </div>
      </div>
</body>
</html>
