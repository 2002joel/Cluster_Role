<?php
session_start();
include 'conexion.php';

if (!isset($_SESSION['id_user'])) {
  die("No autorizado");
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
exit;
