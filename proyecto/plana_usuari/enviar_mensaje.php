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


$id_user = $_SESSION['id_user'];
$mensaje = trim($_POST['mensaje'] ?? '');

if ($mensaje !== '') {
  // Insertar en la tabla chat
  $stmt = $conn->prepare("INSERT INTO chat (id_user, text, date) VALUES (?, ?, NOW())");
  $stmt->bind_param("is", $id_user, $mensaje);
  $stmt->execute();
  $id_chat = $stmt->insert_id;

  // Insertar en la tabla de relación
  $stmt2 = $conn->prepare("INSERT INTO chat_usuarios (id_chat, id_usuarios) VALUES (?, ?)");
  $stmt2->bind_param("ii", $id_chat, $id_user);
  $stmt2->execute();
}

header("Location: usuario.php");
$_SESSION['LAST_ACTIVITY'] = time();
exit;
