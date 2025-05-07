<?php
include 'conexion.php';

// Asegúrate de que no llames a session_start() aquí si ya lo has hecho antes
// session_start();  // Elimina esta línea si ya lo has llamado en otro lugar

// Verifica que la sesión tiene un id_user
if (!isset($_SESSION['id_user'])) {
  die("Usuario no autenticado.");
}

$id_usuario = $_SESSION['id_user'];  // Asigna el valor del id_user de la sesión

$query = "SELECT u.user_name 
          FROM usuario_amigos f
          JOIN usuarios u ON f.id_amigo = u.id_user 
          WHERE f.id_usuario = ?";  // Utiliza el parámetro adecuado en la consulta

// Prepara la consulta
$stmt = $conn->prepare($query);

if (!$stmt) {
    die("Error en la preparación de la consulta: " . $conn->error);
}

// Enlaza el parámetro con el tipo de dato adecuado
$stmt->bind_param("i", $id_usuario);  // Usa $id_usuario, no $id_usuario_actual

// Ejecuta la consulta
$stmt->execute();

// Obtén el resultado
$result = $stmt->get_result();

// Muestra los amigos
if ($result && $result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    echo "<li>" . htmlspecialchars($row['user_name']) . "</li>";
  }
} else {
  echo "<li>No hay amigos</li>";
}

// Cierra la consulta y la conexión
$stmt->close();
$conn->close();
?>

