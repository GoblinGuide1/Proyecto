<!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Registro</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body class="PI">
        
<?php
include("Conexion.php");
include("controlesRegistro.php");
?>

    <div class="Formulario">
    <h1>Registro de usuario</h1>
    <form method="post">
    <div class="username">
        <input type="text" name="NombeUS" required>
        <label for="">Nombre De Usuario</label>
    </div>
    <div class="username">
        <input type="text" name="password1" required>
        <label for="">Contraseña</label>
    </div>
    <div class="username">
        <input type="text" name="configPass" required>
        <label for="">Confirmar Contraseña</label>
    </div>
    
    <div class="username">
        <input type="text" name="NombrePersona" required>
        <label for="">Nombre Persona</label>
    </div>

    <div class="username">
        <input type="text" name="Apellido1" required>
        <label for="">Apellido 1</label>
    </div>

    <div class="username">
        <input type="text" name="Apellido2" required>
        <label for="">Apellido 2</label>
    </div>

    <input type="submit" value="Registrarse">
    <div class="VInicio">
    
        ¿Ya tiene una cuenta?  <a href="index.php">Iniciar Sesión</a>

        <?php if (!empty($mensaje)) : ?>
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