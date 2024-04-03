<?php
$user = $_POST["username"];
$pass = $_POST["password"];

$servurl = "http://localhost:3001/usuarios/$user/$pass";
$curl = curl_init($servurl);

curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($curl);
curl_close($curl);

if ($response === false){
    header("Location:  sesionErronea.php");
    exit;
}

$resp = json_decode($response, true); // Decodificar como un array asociativo

if (!empty($resp)) {
    session_start();
    $_SESSION["usuario"] = $user;

    
    $rol = $resp[0]['rol'];
    
    // Verificar si el usuario es administrador o usuario
    if ($rol == "administrador") {
        echo "admin";
        header("Location:admin.php");
        
    } 
    elseif( $rol == "usuario")
    {
        echo "usuario";
            header("Location:app.php");
        
    }
    else{
        header("Location: sesionErronea.php");
          exit;
    }
  
} 
else {

    header("Location: sesionErronea.php");
    exit;
}
?>
