<?php
session_start();
include 'conexion.php';

// Consulta de los últimos 10 mensajes con el nombre del usuario
$consulta = "
  SELECT chat.text, chat.date, usuarios.user_name
  FROM chat
  JOIN chat_usuarios ON chat.id_chat = chat_usuarios.id_chat
  JOIN usuarios ON chat_usuarios.id_usuarios = usuarios.id_user
";
                                     
$resultado = $conn->query($consulta);

if ($resultado && $resultado->num_rows > 0) {
  while ($row = $resultado->fetch_assoc()) {
    echo '<div class="chat-bubble mb-2">';
    echo '<strong>' . htmlspecialchars($row['user_name']) . ':</strong> ';
    echo htmlspecialchars($row['text']);
    echo '<div style="font-size: 0.75em; color: gray;">' . date('H:i', strtotime($row['date'])) . '</div>';
    echo '</div>';
  }
} else {
  echo '<div class="alerta mb-2">No hay mensajes aún.</div>';
}
?>
