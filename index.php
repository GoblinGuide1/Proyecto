<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="PI">
<?php
include("Conexion.php");
include("Controlador.php");
?>
    <div class="Formulario">
<h1>Inicio de sesión</h1>
<form method="post">
<div class="username">
    <input type="text" name="NombeU" required>
    <label for="">Nombre De Usuario</label>
</div>
<div class="username">
    <input type="password" name="password" required>
    <label for="">Contraseña</label>
</div>
<div class="recordar"> <a href="olvidoContraseña.php">¿Olvido su contraseña?</a></div>
                                                                                          
<input type="submit" name="btninicio" value="Iniciar">                         

<div class="registrarse">

    quiere <a href="registro.php">registrarse</a>

    <?php if (!empty($mensaje) && isset($_POST["NombeU"]) && isset($_POST["password"])) : ?>
            <div class="mensaje-error">
                <?php echo $mensaje; ?>
                <?php unset($_SESSION["mensaje"]); ?>
            </div>
        <?php endif; ?>
</div>
</form>

    </div>
</body>
</html>