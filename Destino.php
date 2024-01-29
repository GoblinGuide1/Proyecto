<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stylesD.css">
    <title>Destino</title>
</head>
<body>
<header>
    <nav class="nav">
        <input type="checkbox" id="toggle">
        <div class="titulo">destinos</div>
        <ul class="list">
            <li><a href="#">Login</a></li> 
            <li><a href="Home.html">Destinos</a></li>
        </ul>
        <label for="toggle" class="icon-bars">
            <div class="line"></div>
            <div class="line"></div>
            <div class="line"></div>
        </label>
    </nav>
</header>
<?php
include("Conexion.php");

// Function to obtain the parameter "nombreDestino" from the URL
function obtenerParametro($nombre) {
    return isset($_GET[$nombre]) ? $_GET[$nombre] : null;
}

$nombreDestino = obtenerParametro("nombreDestino");
$tipoDestino = obtenerParametro("tipoDestino");

if ($nombreDestino !== null) {
    // Utiliza consultas preparadas para evitar inyección SQL
    $query = "SELECT imagen FROM destinos WHERE nombre = ?";
    $stmt = $conn->prepare($query);

    // Verifica si la preparación de la consulta fue exitosa
    if ($stmt) {
        $stmt->bind_param("s", $nombreDestino);
        $stmt->execute();
        $stmt->bind_result($imagen);

        // Verifica si se obtuvo un resultado
        if ($stmt->fetch()) {
            // Se encontró la imagen en la base de datos
            $imagen = base64_encode($imagen);
        } else {
            // No se encontró la imagen en la base de datos, utiliza una imagen predeterminada
            $imagen = base64_encode(file_get_contents("img/recommendation.jpg"));
        }

        $stmt->close();
    } else {
        // Manejar el caso en el que la preparación de la consulta falla
        $imagen = base64_encode(file_get_contents("img/recommendation.jpg"));
    }
} else {
    // Manejar el caso en el que no se proporciona el parámetro "nombreDestino"
    $imagen = base64_encode(file_get_contents("img/recommendation.jpg"));
}

// Actualizar el valor en la tabla preferencia
$queryUpdate = "UPDATE preferencia SET $tipoDestino = $tipoDestino + 1 WHERE idu = '1111'";
$stmtUpdate = $conn->prepare($queryUpdate);

if ($stmtUpdate) {
    $stmtUpdate->execute();
    $stmtUpdate->close();
} 

// Cierra la conexión a la base de datos
$conn->close();
?>
 
<section class="destino-container ciudad"></section> 
    <?php
    // Reducir el tamaño de la imagen
    $imagen = base64_decode($imagen);
    $imagen = imagecreatefromstring($imagen);

    // Obtener las dimensiones originales de la imagen
    $anchoOriginal = imagesx($imagen);
    $altoOriginal = imagesy($imagen);

    // Calcular el nuevo alto proporcional al nuevo ancho 
    $nuevoAncho = 250;
    $nuevoAlto = (int) ($nuevoAncho / $anchoOriginal * $altoOriginal);

    // Crear la nueva imagen con las dimensiones ajustadas
    $nuevaImagen = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

    // Color de fondo blanco para evitar espacios vacíos
    $colorBlanco = imagecolorallocate($nuevaImagen, 255, 255, 255);
    imagefill($nuevaImagen, 0, 0, $colorBlanco);

    // Calcular posición para centrar verticalmente
    $posicionY = max(0, ($nuevoAlto - $altoOriginal) / 2);

    imagecopyresampled($nuevaImagen, $imagen, 0, $posicionY, 0, 0, $nuevoAncho, $nuevoAlto, $anchoOriginal, $altoOriginal);

    ob_start();
    imagejpeg($nuevaImagen, null, 80);
    $imagenReducida = base64_encode(ob_get_clean());
 
    // Liberar recursos
    imagedestroy($imagen);
    imagedestroy($nuevaImagen);

    // Cambiar las dimensiones de la sección original
    $anchoSeccionOriginal = $nuevoAncho; // Puedes ajustar esto según sea necesario
    $altoSeccionOriginal = $nuevoAlto;   // Puedes ajustar esto según sea necesario
    ?>




    <img id='imagen' src="data:image/jpeg;base64,<?php echo $imagenReducida; ?>" alt="Imagen del destino" style="display: block; margin: 0 auto; max-width: 100%; height: auto;"> 

    <div class="info">
        <!-- Aquí es donde se mostrará el nombre del destino -->
        <h1 id="nombre-destino">Nombre del Destino</h1>
        <p id="descripcion">Una breve descripción del destino...</p>
        <p id="tipo">Tipo de destino: Playa</p>
        <p id="actividades">Actividades: Actividad 1, Actividad 2, Actividad 3</p>
        <p id="precio">Precio: 0.00 Colones</p>
        <a href="#">Reservar</a>
    </div>

    <script>
        // Función para obtener el parámetro "nombreDestino" de la URL
        function obtenerParametro(nombre) {
            const urlParams = new URLSearchParams(window.location.search);
            return urlParams.get(nombre);
        }

        // Obtener los valores de los parámetros "nombreDestino", "imagenDestino" y "descripcionDestino"
        const nombreDestino = obtenerParametro("nombreDestino");
        const imagenDestino = obtenerParametro("imagenDestino");
        const descripcionDestino = obtenerParametro("descripcionDestino");
        const tipoDestino = obtenerParametro("tipoDestino");

        // Mostrar los valores en los elementos correspondientes
        const tituloDestino = document.getElementById("nombre-destino");
        tituloDestino.textContent = nombreDestino;

        const descripcion = document.getElementById("descripcion");
        descripcion.textContent = descripcionDestino;

        const tipo = document.getElementById("tipo");
        tipo.textContent = tipoDestino; 

        const imagen = document.querySelector(".destino-container img");
        imagen.src = imagenDestino;
    </script>


 
</body>
</html>
