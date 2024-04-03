<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error 404 - Página no encontrada</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            flex-direction: column;
        }
        h1 {
            margin-bottom: 10px;
        }
        p {
            margin-bottom: 20px;
        }
        a {
            color: #007bff;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <h1>Error 404 - Página no encontrada</h1>
    <p>La página que estás buscando no existe.</p>
    <?php
    // Verificar si existe el encabezado HTTP_REFERER
    if (isset($_SERVER['HTTP_REFERER'])) {
        // Obtener la URL anterior
        $previous_page = $_SERVER['HTTP_REFERER'];
    } else {
        // Si no hay URL anterior, redirigir al inicio
        $previous_page = 'index.html'; // Puedes cambiar esto según tu necesidad
    }
    ?>
    <p><a href="<?php echo $previous_page; ?>">Volver a la página anterior</a></p>
</body>
</html>
