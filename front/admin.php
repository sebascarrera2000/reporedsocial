<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/x-icon" href="./img/logo.png" />
  <title>Dm Me</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <!-- Estilos personalizados -->
  <link rel="stylesheet" href="styles.css">
</head>
<body>
<?php
        session_start();
        $us=$_SESSION["usuario"];
        if ($us==""){
            header("Location: index.html");
        }
    ?>
  <!-- Navbar -->
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

  <!-- Contenido principal -->
  <div class="container mt-4">
    <h2 class="mb-4">Todos los Usuarios <a href="register.php"> <button type="button" class="btn btn-primary">+ Usuarios</button></a></h2>
    
    <div class="row">
      <?php
      // URL de la API
      $url = 'http://localhost:3001/usuarios';

      // Realizar solicitud GET a la API
      $response = file_get_contents($url);

      // Decodificar la respuesta JSON
      $usuarios = json_decode($response, true);

      // Iterar sobre los usuarios y mostrarlos en tarjetas
      foreach ($usuarios as $usuario) {
        echo '<div class="col-md-4">';
        echo '<div class="card mb-4">';
        echo '<div class="card-body">';
        echo '<h5 class="card-title">' . $usuario['nombre_completo'] . '</h5>';
        echo '<p class="card-text">@' . $usuario['usuario'] . '</p>';
        echo '<form method="post" action="seguirAdmin.php">';
        echo '<input type="hidden" name="usuarioS" value="' . $usuario['id'] . '">';
        echo '<button type="submit" class="btn btn-primary btn-block">Seguir</button>';
        echo '</form>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
      }
      ?>
    </div>
  </div>

  <!-- Bootstrap JS (opcional) -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
