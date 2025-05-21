<?php
session_start();
require_once 'conexion.php';

if (!isset($_SESSION['id_user'])) {
    die("Debes iniciar sesión.");
}

$id_user = $_SESSION['id_user'];
$id_group = isset($_GET['id_group']) ? intval($_GET['id_group']) : 0;

if ($id_group <= 0) {
    die("Grupo no válido.");
}

// Verificar si el usuario está en el grupo
$stmt = $conn->prepare("SELECT 1 FROM user_group WHERE id_user = ? AND id_group = ?");
$stmt->bind_param("ii", $id_user, $id_group);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows === 0) {
    die("No estás en el grupo, no puedes enviar mensajes.");
}
$stmt->close();

// Si se ha enviado un mensaje
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['mensaje'])) {
    $mensaje = trim($_POST['mensaje']);
    if ($mensaje !== '') {
        $stmt = $conn->prepare("INSERT INTO chat_game (id_user, id_group, mensaje, fecha_envio) VALUES (?, ?, ?, NOW())");
        $stmt->bind_param("iis", $id_user, $id_group, $mensaje);
        $stmt->execute();
        $stmt->close();

        // Recarga para mostrar el mensaje
        header("Location: mostrar_partida.php?id_group=" . $id_group);
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Chat del Grupo <?= htmlspecialchars($id_group) ?></title>
    <style>
        body { font-family: sans-serif; }
        .chat-box { border: 1px solid #ccc; height: 300px; overflow-y: auto; padding: 10px; margin-bottom: 10px; }
        .mensaje { margin-bottom: 5px; }
        .form-chat { display: flex; gap: 10px; }
        .form-chat textarea { flex-grow: 1; resize: none; }
    </style>
</head>
<body>

<h3>Chat del Grupo #<?= htmlspecialchars($id_group) ?></h3>

<div class="chat-box">
    <?php
    $stmt = $conn->prepare("
        SELECT u.user_name, c.mensaje, c.fecha_envio
        FROM chat_game c
        JOIN usuarios u ON u.id_user = c.id_user
        WHERE c.id_group = ?
        ORDER BY c.fecha_envio ASC
    ");
    $stmt->bind_param("i", $id_group);
    $stmt->execute();
    $stmt->bind_result($nombre, $mensaje, $fecha);

    while ($stmt->fetch()) {
        echo "<div class='mensaje'><strong>" . htmlspecialchars($nombre) . ":</strong> " . htmlspecialchars($mensaje) . " <small>[" . $fecha . "]</small></div>";
    }

    $stmt->close();
    ?>
</div>

<form class="form-chat" method="post">
    <textarea name="mensaje" rows="2" placeholder="Escribe tu mensaje..."></textarea>
    <button type="submit">Enviar</button>
</form>

</body>
</html>
