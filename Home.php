<?php
session_start();
error_reporting(0);
include('config.php');
include('head.php');
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stylesH.css">
    <link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
<link href="css/style.css" rel='stylesheet' type='text/css' />
<link href="css/font-awesome.css" rel="stylesheet">
<script src="js/jquery-1.12.0.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<link href="css/animate.css" rel="stylesheet" type="text/css" media="all">
<script src="js/wow.min.js"></script>
	<script>
		new WOW().init(); 
	</script>
    <title>Inicio</title>
	
</head>
<body>



<div class="container">
	<div class="holiday">
	

<br>

	
	<h3>Lista de paquetes</h3>

	<form  method="get">
    <label for="filtroDestino">Selecciona un tipo de destino:</label>
    <select name="filtroDestino" id="filtroDestino">
	<option value="ciudad">todos</option>
        <option value="playa">Playa</option>
        <option value="montana">Montaña</option>
        <option value="ciudad">Ciudad</option>
		
    </select>
<br>
<br>
    <input type="submit" value="Filtrar">
	<?php
// Procesar el formulario y redirigir según la opción seleccionada
if(isset($_GET['filtroDestino'])) {
    $filtroSeleccionado = $_GET['filtroDestino'];

    // Redirigir según la opción seleccionada
    switch ($filtroSeleccionado) {
		case 'todos':
            header("Location: home.php");
            exit();
        case 'playa':
            header("Location: playa.php");
            exit();
        case 'montana':
            header("Location: montana.php");
            exit();
        case 'ciudad':
            header("Location: ciudad.php");
            exit();
        default:
            // Manejar caso por defecto o errores
            break;
    }
}
?>
</form>

<?php
// Obtener el tipo de destino con el número mayor de preferencias
$user = $_SESSION['login']; 

// Obtener el tipo de destino con el número mayor de preferencias
$sql = "SELECT 
            CASE 
                WHEN playa >= montana AND playa >= ciudad THEN 'playa'
                WHEN montana >= playa AND montana >= ciudad THEN 'montana'
                ELSE 'ciudad'
            END AS mostPreferredType
        FROM preferencia
        WHERE idU = '$user'"; 

$query = $dbh->prepare($sql);
$query->execute();

$result = $query->fetch(PDO::FETCH_ASSOC);

if ($result) {
    // Corregir la asignación del tipo de destino más preferido
    $mostPreferredType = $result['mostPreferredType'];

    // Obtener un destino aleatorio del tipo de destino más preferido
    $sql = "SELECT * FROM tbltourpackages WHERE PackageType = :mostPreferredType ORDER BY RAND() LIMIT 1";
    $query = $dbh->prepare($sql);
    $query->bindParam(':mostPreferredType', $mostPreferredType, PDO::PARAM_STR);
    $query->execute();
    $randomDestination = $query->fetch(PDO::FETCH_ASSOC);

    // Continuar con el resto del código...
} else {
    // Manejar el caso en el que no se encuentran preferencias para el usuario
    echo "No se encontraron preferencias para el usuario.";
}
?>


<div class="rom-btm" id="recomendacion">
    <h3>Recomendadión</h3>
    <div class="col-md-3 room-left wow fadeInLeft animated" data-wow-delay=".5s">
        <img src="images/<?php echo htmlentities($randomDestination['PackageImage']);?>" class="img-responsive" alt="">
    </div>
    <div class="col-md-6 room-midle wow fadeInUp animated" data-wow-delay=".5s">
        <h4 class="Nombre" id="nombreDestino">Nombre del destino: <?php echo htmlentities($randomDestination['PackageName']);?></h4>
        <h6 class="tipo" id="tipoDestino">Tipo de destino : <?php echo htmlentities($randomDestination['PackageType']);?></h6>
        <p><b>Ubicación del destino :</b> <?php echo htmlentities($randomDestination['PackageLocation']);?></p>
        <p><b class="descripcion" id="descripcionDestino">Características</b> <?php echo htmlentities($randomDestination['PackageFetures']);?></p>
    </div>
    <div class="col-md-3 room-right wow fadeInRight animated" data-wow-delay=".5s">
        <h5>USD <?php echo htmlentities($randomDestination['PackagePrice']);?></h5>
        <a href="Destino.php?pkgid=<?php echo htmlentities($randomDestination['PackageId']);?>" class="view">Detalles</a>
    </div>
    <div class="clearfix"></div>
</div>

<?php $sql = "SELECT * from tbltourpackages order by rand() ";
$query = $dbh->prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{	?>
			<div class="rom-btm">
				<div class="col-md-3 room-left wow fadeInLeft animated" data-wow-delay=".5s">
					<img src="images/<?php echo htmlentities($result->PackageImage);?>" class="img-responsive" alt="">
				</div>
				<div class="col-md-6 room-midle wow fadeInUp animated" data-wow-delay=".5s">
					<h4 class="Nombre" id="nombreDestino">Nombre del destino: <?php echo htmlentities($result->PackageName);?></h4>
					<h6 class="tipo" id="tipoDestino">Tipo de destino : <?php echo htmlentities($result->PackageType);?></h6>
					<p><b>Ubicación del destino :</b> <?php echo htmlentities($result->PackageLocation);?></p>
					<p><b class="descripcion" id="descripcionDestino">Características</b> <?php echo htmlentities($result->PackageFetures);?></p>
				</div>
				<div class="col-md-3 room-right wow fadeInRight animated" data-wow-delay=".5s">
					<h5>USD <?php echo htmlentities($result->PackagePrice);?></h5>
					<a href="Destino.php?pkgid=<?php echo htmlentities($result->PackageId);?>" class="view">Detalles</a>
				</div>
				<div class="clearfix"></div>
			</div>

<?php }} ?>
			
		


</body>
</html>
