<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
header('Content-Type: application/json');

include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['id_report'])) {
    $id = intval($_POST['id_report']);
    $fecha = date('Y-m-d H:i:s');

    $sql = "UPDATE reportes SET resolved = 1, resolved_date = ? WHERE id_report = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        echo json_encode(["success" => false, "error" => $conn->error]);
        exit;
    }

    $stmt->bind_param("si", $fecha, $id);
    if ($stmt->execute()) {
        echo json_encode([
            "success" => true,
            "resolved_date" => $fecha
        ]);
    } else {
        echo json_encode([
            "success" => false,
            "error" => $stmt->error
        ]);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(["success" => false, "error" => "No se recibió ID válido"]);
}




