<?php
session_start();

if (!isset($_SESSION['id_user'])) {
    die("Debes iniciar sesión.");
}

$id_user = $_SESSION['id_user'];

if (isset($_GET['id'])) {
    $id_group = intval($_GET['id']);

    $conexion = new mysqli("localhost", "root", "", "tu_base_de_datos");
    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }

    $stmt = $conexion->prepare("DELETE FROM user_group WHERE id_user = ? AND id_group = ?");
    $stmt->bind_param("ii", $id_user, $id_group);
    $stmt->execute();

    $stmt->close();
    $conexion->close();

    header("Location: grupos.html");
    exit;
}
?>
