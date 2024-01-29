<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stylesH.css">
    <title>Inicio</title>
</head>
<body>

  <nav class="nav">
    <input type="checkbox" id="toggle">

    <div class="titulo">destinos</div>
    <ul class="list">
       <li><a href="index.html">Login</a></li> 
       <li><a href="Home.html">Destinos</a></li>
    </ul>

    <label for="toggle" class="icon-bars">
        <div class="line"></div>
        <div class="line"></div>
        <div class="line"></div>
    </label>

  </nav>

    <section class="recommendation">
        <?php
        include("Conexion.php");
        

        // Realizar la consulta para obtener un registro aleatorio de la tabla destinos
        $query = "SELECT nombre, descripcion, tipo, imagen FROM destinos ORDER BY RAND() LIMIT 1";
        $resultado = $conn->query($query);

        if ($resultado) {
            // Obtener los datos del registro aleatorio
            $registro = mysqli_fetch_assoc($resultado);
            $nombre = $registro['nombre'];
            $descripcion = $registro['descripcion'];
            $tipo = $registro['tipo'];
            $imagen = base64_encode($registro['imagen']);
        } else {
            // En caso de error, establecer valores predeterminados
            $nombre = "Playa Bananito";
            $descripcion = "Descripción del destino";
            $tipo = "tipo de destino";
            $imagen = base64_encode(file_get_contents("img/recommendation.jpg"));
        }

        mysqli_free_result($resultado);
        $conn->close();
        ?> 

        <h2>Recomendación del día</h2>
        <div class="recommendation-container">
            <?php
            // Reducir el tamaño de la imagen
            $imagen = base64_decode($imagen);
            $imagen = imagecreatefromstring($imagen);
            $nuevaImagen = imagecreatetruecolor(200, 200);
            imagecopyresampled($nuevaImagen, $imagen, 0, 0, 0, 0, 200, 200, imagesx($imagen), imagesy($imagen));
            ob_start();
            imagejpeg($nuevaImagen, null, 80);
            $imagenReducida = base64_encode(ob_get_clean());
            imagedestroy($imagen);
            imagedestroy($nuevaImagen);
            ?>

            <img class="Imagen" id="imagenDestino" src="data:image/jpeg;base64,<?php echo $imagenReducida; ?>" alt="Recomendación">
            
            <!-- Añade un ID al elemento h3 para poder obtener su texto con JavaScript -->
            <h3 class="Nombre" id="nombreDestino"><?php echo $nombre; ?></h3>
            
            <p class="Descripcion" id="descripcionDestino"><?php echo $descripcion; ?></p>
            <p class="Tipo" id="tipo"><?php echo $tipo; ?></p>
            
            <!-- Cambia el enlace por un botón con el evento onclick -->
            <button onclick="enviarTextoDestino()">Información detallada</button>
        </div>
        </section>


    <script>
        // Función para obtener el texto dentro del elemento h3
        function obtenerTextoDestino() {
            return document.getElementById("nombreDestino").textContent;
        }

        // Función para obtener la descripción del destino
        function obtenerDescripcionDestino() {
            return document.getElementById("descripcionDestino").textContent;
        }

        // Función para obtener la descripción del destino
        function obtenerTipo() {
            return document.getElementById("tipo").textContent;
        }

        // Función para modificar la URL y pasar los datos como parámetros
        function enviarTextoDestino() {
            const textoDestino = obtenerTextoDestino();
            const descripcionDestino = obtenerDescripcionDestino();
            const tipoDestino = obtenerTipo();

            const urlParams = new URLSearchParams();
            urlParams.append("nombreDestino", textoDestino);
            urlParams.append("descripcionDestino", descripcionDestino);
            urlParams.append("tipoDestino", tipoDestino); 

            window.location.href = "Destino.php?" + urlParams.toString();
        }
    </script>  
</body>
</html>
