<?php
require_once 'conexion.php';

$id_partida = $_GET['id_partida'] ?? 0;
if (!$id_partida) {
    die("ID de partida no especificado.");
}

$stmt = $conn->prepare("SELECT id_partida, id_group, id_creador, mapa, fecha_inicio, fecha_fin, estado FROM partida WHERE id_partida = ?");
$stmt->bind_param("i", $id_partida);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows == 0) {
    die("Partida no encontrada.");
}

$stmt->bind_result($id_partida, $id_group, $id_creador, $mapa, $fecha_inicio, $fecha_fin, $estado);
$stmt->fetch();
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8" />
<title>Detalles de la Partida #<?= htmlspecialchars($id_partida) ?></title>
</head>
<body>

<h1>Detalles de la Partida #<?= htmlspecialchars($id_partida) ?></h1>

<ul>
    <li><strong>ID Grupo:</strong> <?= htmlspecialchars($id_group) ?></li>
    <li><strong>ID Creador:</strong> <?= htmlspecialchars($id_creador) ?></li>
    <li><strong>Fecha Inicio:</strong> <?= htmlspecialchars($fecha_inicio) ?></li>
    <li><strong>Fecha Fin:</strong> <?= htmlspecialchars($fecha_fin ?: 'No especificada') ?></li>
    <li><strong>Estado:</strong> <?= htmlspecialchars($estado) ?></li>
</ul>

<h2>Mapa</h2>
<?php if ($mapa): ?>
    <img src="data:image/jpeg;base64,<?= base64_encode($mapa) ?>" alt="Mapa de la partida" style="max-width:600px;">
<?php else: ?>
    <p>No hay imagen de mapa disponible.</p>
<?php endif; ?>
<iframe src="chat_partida_enviar.php?id_group=<?= $id_group ?>" frameborder="0" width="100%" height="450px"></iframe>

</iframe>

</body>
</html>
