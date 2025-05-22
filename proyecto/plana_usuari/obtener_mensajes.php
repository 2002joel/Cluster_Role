<?php
session_start();
include 'conexion.php';

// Tiempo de inactividad máximo en segundos (por ejemplo, 15 minutos)
$tiempo_inactividad = 900;  // 900 segundos = 15 minutos

// Verifica si ya existe la última actividad en la sesión
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > $tiempo_inactividad)) {
    // Si ha pasado más tiempo que el permitido, destruye la sesión
    session_unset();    // Elimina todas las variables de sesión
    session_destroy();  // Destruye la sesión
    header("Location: login.php?mensaje=sesion_caducada"); // Redirige al login o página de aviso
    exit();
}


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
    echo '<div class="chat-bubble mb-2" style=" background-color: #c0c0c0;">';
    echo '<strong style="background-color: #c0c0c0;">' . htmlspecialchars($row['user_name']) . ':</strong> ';
    echo htmlspecialchars($row['text']);
    echo '<div style="font-size: 0.75em; color: gray; background-color: #c0c0c0;">' . date('H:i', strtotime($row['date'])) . '</div>';
    echo '</div>';
  }
} else {
  echo '<div class="alerta mb-2">No hay mensajes aún.</div>';
}
$_SESSION['LAST_ACTIVITY'] = time();
?>
