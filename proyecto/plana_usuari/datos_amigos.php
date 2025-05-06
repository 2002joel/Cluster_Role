<?php
include 'conexion.php';

$id_usuario_actual = 1; // Usa $_SESSION['id_user'] si tienes login

$query = "SELECT u.user_name FROM amigos f
          JOIN usuarios u ON f.id_friend = u.id_user
          WHERE f.id_user = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id_usuario_actual);
$stmt->execute();
$result = $stmt->get_result();

if ($result && $result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    echo "<li>" . htmlspecialchars($row['user_name']) . "</li>";
  }
} else {
  echo "<li>No hay amigos</li>";
}
?>
