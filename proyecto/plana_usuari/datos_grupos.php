<?php
include 'conexion.php';

$query = "SELECT group_name FROM grupo ORDER BY creation_date DESC LIMIT 5";
$result = $conn->query($query);

if ($result && $result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    echo "<li>" . htmlspecialchars($row['group_name']) . "</li>";
  }
} else {
  echo "<li>No hay grupos</li>";
}
?>
