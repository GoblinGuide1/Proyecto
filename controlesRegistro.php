<?php
include("Conexion.php");


// Validar el formulario de registro
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si los campos del formulario están definidos
    if (isset($_POST["NombeUS"]) && isset($_POST["password1"]) && isset($_POST["configPass"])
        && isset($_POST["NombrePersona"]) && isset($_POST["Apellido1"]) && isset($_POST["Apellido2"])) {

        $username = $_POST["NombeUS"];
        $password = $_POST["password1"];
        $confirm_password = $_POST["configPass"];
        $nombre = $_POST["NombrePersona"];
        $apellido1 = $_POST["Apellido1"];
        $apellido2 = $_POST["Apellido2"];

        // Verificar si el nombre de usuario ya está en uso
        $sql_check_username = "SELECT * FROM usuario WHERE usuario = '$username'";
        $result_check_username = $conn->query($sql_check_username);

        if ($result_check_username->num_rows > 0) {
            $mensaje =  "El nombre de usuario ya está en uso. Por favor, elija otro.";
        } elseif ($password !== $confirm_password) {
            $mensaje =  "Las contraseñas no coinciden. Por favor, inténtelo de nuevo.";
        } else {
            // Insertar el nuevo usuario en la base de datos
            $hashed_password =   $confirm_password; // Hash de la contraseña

            $sql_insert_user = "INSERT INTO usuario (usuario, contrasena, NombrePersona, Apellido1, Apellido2)
                                VALUES ('$username', '$hashed_password', '$nombre', '$apellido1', '$apellido2')";
            
            if ($conn->query($sql_insert_user) === TRUE) {
                $mensaje =  "Registro exitoso. Ahora puede iniciar sesión.";
            } else {
                $mensaje =  "Error al registrar usuario: " . $conn->error;
            }
        }
    } else {
        $mensaje =  "Por favor, complete todos los campos.";
    }
}

// Cerrar la conexión
$conn->close();
?>
?>