<?php
session_start();
$us = $_SESSION["usuario"];
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Obtener el ID del usuario utilizando la API
$url = "http://localhost:3001/usuarios/$us";
$response = file_get_contents($url);
$usuario_data = json_decode($response, true);

// Verificar si se obtuvo la información del usuario correctamente
if ($usuario_data && isset($usuario_data[0]['id'])) {
    $usuario_id = $usuario_data[0]['id'];
    echo $usuario_id;
} else {
    // Manejar el caso en el que no se pueda obtener el ID del usuario
    $usuario_id = null;
}

    // Obtener los datos del formulario
    $contenido = $_POST["contenido"];

    // URL de la API para crear mensajes
    $url = 'http://localhost:3002/mensajes';

    // Datos del nuevo mensaje
    $nuevoMensaje = array(
        'usuarioId' => $usuario_id,
        'contenido' => $contenido
    );

    // Inicializar cURL para realizar la solicitud POST a la API
    $curl = curl_init($url);

    // Configurar las opciones de la solicitud
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($nuevoMensaje));
    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    // Ejecutar la solicitud
    $response = curl_exec($curl);

    // Verificar si hubo un error en la solicitud
    if (!$response) {
        echo "Error al crear el mensaje.";
    } else {
        // Decodificar la respuesta JSON
        $data = json_decode($response, true);

        // Verificar si la respuesta contiene un mensaje de éxito
        if (isset($data['message'])) {
            // Mostrar el mensaje de éxito
            echo $data['message'];
            header("Location:mensajeria.php");
        } else {
            // Mostrar un mensaje de error genérico
            echo "Error al crear el mensaje.";
            header("Location:404.php");
        }
    }

    // Cerrar la conexión cURL
    curl_close($curl);
}
?>
