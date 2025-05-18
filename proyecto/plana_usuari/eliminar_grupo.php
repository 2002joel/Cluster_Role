<?php
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_group = $_POST['id_group'] ?? null;

    if (!$id_group) {
        die("ID de grupo no proporcionado.");
    }

    // Primero elimina las relaciones del grupo con usuarios
    $stmt1 = $conn->prepare("DELETE FROM user_group WHERE id_group = ?");
    $stmt1->bind_param("i", $id_group);
    $stmt1->execute();
    $stmt1->close();

    // Ahora sí puedes eliminar el grupo
    $stmt2 = $conn->prepare("DELETE FROM grupo WHERE id_group = ?");
    $stmt2->bind_param("i", $id_group);

    if ($stmt2->execute()) {
        header("Location: grupos.php?eliminado=1");
        exit;
    } else {
        echo "Error al eliminar el grupo.";
    }
}
?>
