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

    // Obtener usuarios seguidos por el usuario actual
    $url_seguidos = "http://localhost:3003/seguimientos/$usuario_id";
    $response_seguidos = file_get_contents($url_seguidos);
    $seguidos = json_decode($response_seguidos, true);

    // Recuperar los mensajes creados por los usuarios seguidos
    $mensajes_seguidos = array();
    if ($seguidos && is_array($seguidos)) {
        foreach ($seguidos as $seguido) {
            $id_seguido = $seguido['usuarioS_id'];
            $url_mensajes_seguido = "http://localhost:3002/mensajes/$id_seguido";
            $response_mensajes_seguido = file_get_contents($url_mensajes_seguido);
            $mensajes_seguido = json_decode($response_mensajes_seguido, true);
            if ($mensajes_seguido && is_array($mensajes_seguido)) {
                $mensajes_seguidos = array_merge($mensajes_seguidos, $mensajes_seguido);
            }
        }
    }
} else {
    // Manejar el caso en el que no se pueda obtener el ID del usuario
    $usuario_id = null;
    $seguidos = null;
    $mensajes_seguidos = null;
}
?>

<!DOCTYPE html>
<html lang="en">
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
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <img src="./img/logo.png" alt="" style="width: 70px">
        <a class="navbar-brand" href="#">DM ME</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link" href="app.php">Usuarios</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="seguimiento.php">Seguidores</a>
            </li>
            <li class="nav-item">
            <?php echo "<a class='nav-link' href='logout.php'>Logout $us</a>"; ?>
            </li>
          </ul>
        </div>
        </nav>
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <!-- Usuarios seguidos -->
            <div class="card mt-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="m-0">Usuarios Seguidos</h5>
                </div>
                <div class="card-body">
                    <?php
                    if ($seguidos && is_array($seguidos)) {
                      echo '<div class="row">';
                        foreach ($seguidos as $seguido) {
                            $id_seguido = $seguido['usuarioS_id'];
                            $url_usuario_seguido = "http://localhost:3001/usuariosId/$id_seguido";
                            $response_usuario_seguido = file_get_contents($url_usuario_seguido);
                            $usuario_seguido_data = json_decode($response_usuario_seguido, true);
                            if ($usuario_seguido_data && is_array($usuario_seguido_data)) {
                                $nombre_seguido = $usuario_seguido_data[0]['usuario'];
                                echo '<div class="col-md-3 mb-4">';
                                echo '<div class="card card-sm">';
                                echo '<img src="./assets/seguido.svg" alt="Icono de usuario" class="card-img-top">';
                                echo '<div class="card-body text-center">';
                                echo "<div>@$nombre_seguido</div>";
                                echo '</div>';
                                echo '</div>';
                                echo '</div>';
                            }
                        } 
                        echo '</div>';
                    } 
                    
                    else {
                        echo 'No sigues a ningún usuario.';
                    }
                    ?>
                </div>
            </div>

            <!-- Mensajes de usuarios seguidos -->
            <div class="card mt-4">
                <div class="card-header bg-success text-white">
                    <h5 class="m-0">Mensajes de Usuarios Seguidos</h5>
                </div>
                <div class="card-body">
                <?php
                  if ($mensajes_seguidos && is_array($mensajes_seguidos)) {
                      foreach ($mensajes_seguidos as $mensaje_seguido) {
                          if (isset($mensaje_seguido['usuario_id'])) {
                              $id_usuario = $mensaje_seguido['usuario_id'];
                              $url_usuario = "http://localhost:3001/usuariosId/$id_usuario";
                              $response_usuario = file_get_contents($url_usuario);
                              $usuario_data = json_decode($response_usuario, true);

                              if ($usuario_data && is_array($usuario_data) && isset($usuario_data[0]['usuario'])) {
                                  $nombre_usuario = $usuario_data[0]['usuario'];
                                  echo '<div class="mb-3">';
                                  echo '<div class="fw-bold">@' . $nombre_usuario . '</div>';
                                  echo '<div>Mensaje: ' . $mensaje_seguido['contenido'] . '</div>';
                                  echo '</div>';
                              }
                          }
                      }
                  } else {
                      echo 'No hay mensajes de usuarios seguidos para mostrar.';
                  }
?>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>