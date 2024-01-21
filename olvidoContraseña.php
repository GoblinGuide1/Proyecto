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
include("controlOlvido.php");
?>
        <div class="Formulario">
    <h1>Recordar Contraseña</h1>
    <form method="post">
    <div class="username">
        <input type="text" name="NombeUS" required>
        <label for="">Nombre De Usuario</label>
    </div>

    <div class="username">
        <input type="text" name="NombrePersona" required>
        <label for="">Nombre Personal</label>
    </div>
    <?php if (!empty($mensaje)) : ?>
            <div class="mensaje-olvi">
                <?php echo $mensaje; ?>
               
            </div>
        <?php endif; ?>
    <input type="submit" value="Recordar">
    <div class="VInicio">
    
        ¿desea volver al   <a href="index.php">Iniciar Sesión?</a>


    </div>
    </form>

    
        </div>
    </body>
    </html>