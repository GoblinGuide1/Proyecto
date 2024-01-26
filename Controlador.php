<?php
include("Conexion.php");
// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Validar el formulario

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["NombeU"];
    $password = $_POST["password"];

    // Consulta para verificar las credenciales
    $sql = "SELECT * FROM usuario WHERE usuario = '$username' AND contrasena = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Las credenciales son válidas
        header("Location: P.html");
        exit();
        // Puedes redirigir al usuario a otra página aquí
    } else {
        // Las credenciales no son válidas
        $mensaje = "Nombre de usuario o contraseña incorrectos.";
    }
}

// Cerrar la conexión
$conn->close();
?>