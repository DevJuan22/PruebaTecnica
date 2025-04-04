<?php
include 'database.php';

// Consulta de prueba
$sql = "SELECT * FROM ofertas";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($fila = $result->fetch_assoc()) {
        echo "ID: " . $fila["id"] . " - Objeto: " . $fila["objeto"] . "<br>";
    }
} else {
    echo "No hay resultados";
}

// Cerrar conexión
$conn->close();
?>