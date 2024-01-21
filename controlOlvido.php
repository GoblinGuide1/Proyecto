<?php
include("Conexion.php");

// Validar el formulario de recordar contraseña
$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombreUsuario = $_POST["NombeUS"];
    $nombrePersonal = $_POST["NombrePersona"];

    // Consulta para verificar si los datos coinciden con un usuario en la base de datos
    $sql = "SELECT * FROM usuario WHERE usuario = '$nombreUsuario' AND NombrePersona = '$nombrePersonal'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Datos coinciden, mostrar la contraseña
        $usuario = $result->fetch_assoc();
        $mensaje = "La contraseña del usuario " . $nombreUsuario . " es: " . $usuario["contrasena"];
    } else {
        // Datos no coinciden
        $mensaje = "Nombre de usuario o nombre personal incorrectos.";
    }
}

// Cerrar la conexión
$conn->close();





?>