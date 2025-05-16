<?php
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_report'])) {
    $id = intval($_POST['id_report']);
    $fecha = date('Y-m-d H:i:s');
    $stmt = $conn->prepare("UPDATE reportes SET resolved = 1, resolved_date = ? WHERE id_report = ?");
    $stmt->bind_param("si", $fecha, $id);
    $stmt->execute();
    $stmt->close();
}

$conn->close();
?>



