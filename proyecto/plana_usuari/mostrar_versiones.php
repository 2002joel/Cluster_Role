<?php
// Conexión a la base de datos

include 'conexion.php';
// Consulta para obtener todas las versiones
$sql = "SELECT * FROM update_log ORDER BY date DESC"; // Reemplaza 'tu_tabla' por el nombre real
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<ul class='mb-0'>";
    while ($row = $result->fetch_assoc()) {
        echo "<li><strong>{$row['version']} - {$row['title']}</strong><br>";
        echo "<em>{$row['short_explanation']}</em><br>";
        echo "<small>{$row['date']}</small><br>";
        echo "<p>{$row['long_explanation']}</p></li><hr>";
    }
    echo "</ul>";
} else {
    echo "<p>No hay versiones registradas.</p>";
}

$conn->close();
?>
