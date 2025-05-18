<?php
include 'conexion.php'; // Incluye la conexión a la base de datos

// Comprobar si la sesión ya está iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$id_usuario = $_SESSION['id_user'] ?? 0; // Obtiene el ID del usuario desde la sesión o 0 si no existe

// Consulta SQL para obtener los últimos 5 grupos a los que el usuario está asignado
$query = "SELECT g.group_name 
          FROM grupo g
          JOIN user_group ug ON g.id_group = ug.id_group
          JOIN usuarios u ON ug.id_user = u.id_user
          WHERE u.id_user = ? 
          ORDER BY g.creation_date DESC 
          LIMIT 5";

$stmt = $conn->prepare($query); // Prepara la consulta
$stmt->bind_param("i", $id_usuario); // Asocia el parámetro con el ID del usuario
$stmt->execute(); // Ejecuta la consulta
$result = $stmt->get_result(); // Obtiene el resultado

if ($result->num_rows === 0) {
    echo "<p>No estás asignado a ningún grupo.</p>";
} else {
    echo "<ul>";
    while ($row = $result->fetch_assoc()) {
        // Evitar null en htmlspecialchars con operador ?? ''
        $group_name = htmlspecialchars($row['group_name'] ?? '');
        echo "<li>" . $group_name . "</li>"; // Muestra el nombre de cada grupo
    }
    echo "</ul>";
}

$stmt->close(); // Cierra la sentencia
$conn->close(); // Cierra la conexión
?>
