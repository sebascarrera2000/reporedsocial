<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $nombre = $_POST["nombre"];
    $usuario = $_POST["usuario"];
    $password = $_POST["password"];
    $rol = $_POST["rol"];
    
    // URL de la API para registrar usuarios
    $url = 'http://localhost:3001/usuarios';
    
    // Datos del nuevo usuario
    $nuevoUsuario = array(
        'nombre_completo' => $nombre,
        'usuario' => $usuario,
        'password' => $password,
        'rol' => $rol // Puedes establecer el rol según tus necesidades
    );
    
    // Inicializar cURL para realizar la solicitud POST a la API
    $curl = curl_init($url);
    
    // Configurar las opciones de la solicitud
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($nuevoUsuario));
    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    
    // Ejecutar la solicitud
    $response = curl_exec($curl);
    
    // Verificar si hubo un error en la solicitud
    if (!$response) {
        echo "Error al registrar el usuario.";
    } else {
        // Decodificar la respuesta JSON
        $data = json_decode($response, true);
        
        // Verificar si la respuesta contiene un mensaje de éxito
        if (isset($data['message'])) {
            // Mostrar el mensaje de éxito
            echo $data['message'];
            header("Location:creacionCuenta.php");
        } else {
            // Mostrar un mensaje de error genérico
            echo "Error al registrar el usuario.";
            header("Location:creacionErronea.php");
        }
    }
    
    // Cerrar la conexión cURL
    curl_close($curl);
}
?>
