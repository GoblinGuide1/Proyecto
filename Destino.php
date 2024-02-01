<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stylesD.css">
	<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
    <title>Destino</title>
</head>
<body>
<header>
    
</header>

<!-- top-header -->
<?php 
include('head.php');
include('config.php');
include('Conexion.php');
?>
<div class="banner-3">
	<div class="container">
		<h1 class="wow zoomIn animated animated" data-wow-delay=".5s" style="visibility: visible; animation-delay: 0.5s; animation-name: zoomIn;"> TMS -Detalles del paquete</h1>
	</div>
</div>
<!--- /banner ---->
<!--- selectroom ---->
<div class="selectroom">
	<div class="container">	
<?php 
$pid=intval($_GET['pkgid']);
$sql = "SELECT * from tbltourpackages where PackageId=:pid";
$query = $dbh->prepare($sql);
$query -> bindParam(':pid', $pid, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0) 
{
foreach($results as $result)
{	
    
    $tipoDestino =$result->PackageType;
    $user =$_SESSION['login'];
    // Actualizar el valor en la tabla preferencia
    
    $queryUpdate = "UPDATE preferencia SET $tipoDestino = $tipoDestino + 1 WHERE idU = '$user'";
    $stmtUpdate = $conn->prepare($queryUpdate);

    if ($stmtUpdate) {
        $stmtUpdate->execute();
        $stmtUpdate->close();
    }     
    // Cierra la conexión a la base de datos
    $conn->close();
?>

<form name="book" method="post">
    <div class="selectroom_top">
        <div class="col-md-4 selectroom_left wow fadeInLeft animated" data-wow-delay=".5s">
            <img src="images/<?php echo htmlentities($result->PackageImage);?>" class="img-responsive" alt="">
        </div>
        <div class="col-md-8 selectroom_right wow fadeInRight animated" data-wow-delay=".5s">
            <h2><?php echo htmlentities($result->PackageName);?></h2>
            <p class="dow">#Paquete-<?php echo htmlentities($result->PackageId);?></p>
            <p><b>Tipo de paquete :</b> <?php echo htmlentities($result->PackageType);?></p>
            <p><b>Ubicación del paquete :</b> <?php echo htmlentities($result->PackageLocation);?></p>
                <p><b>Características</b> <?php echo htmlentities($result->PackageFetures);?></p>
                <div class="ban-bottom">
        </div>
                    <div class="clearfix"></div>
            <div class="grand">
                <p>Gran Total</p>
                <h3>USD.800</h3>
            </div>
        </div>
    <h3>Detalles del paquete</h3>
            <p style="padding-top: 1%"><?php echo htmlentities($result->PackageDetails);?> </p>    
            <div class="clearfix"></div>
    </div>
</form>

<?php 
}} 
?>
	</div>
</div>
</body>
</html>
