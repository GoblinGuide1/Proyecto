<!DOCTYPE html>
<html lang="es">
<head>
<?php
  include("Controlador.php");
 if($_SESSION['login']){
?>
  
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stylesH.css">
    <link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
    <title>Inicio</title>
    <nav class="nav1">
        <input type="checkbox" id="toggle">
    
        <div class="titulo">Turisticos</div>
        <ul class="list"> 
           <li><a href="index.php">Login</a></li> 
           <li><a href="Home.php">Destinos</a></li>
           <li class="#"><?php echo htmlentities($_SESSION['login']);?></li> 

    
        </ul>
    
        <label for="toggle" class="icon-bars">
            <div class="line"></div>
            <div class="line"></div>
            <div class="line"></div>
        </label>
    
      </nav>
</head>
<body>



</body>

<?php }?>
</html>
