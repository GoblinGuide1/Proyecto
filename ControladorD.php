
<?php
include("Conexion.php");
// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Query to retrieve all dates from the destinos table
$sql = "SELECT * FROM destinos";

// Execute the query 
$result = $conn->query($sql);

// Check if there are any results
if ($result->num_rows > 0) {
    // Loop through the results and display the dates
    while ($row = $result->fetch_assoc()) {
        $tipo = $row['tipo'];
        echo $tipo . "<br>";
    }
} else {
    echo "No dates found in the destinos table.";
}

// Close the connection
$conn->close();
?>

