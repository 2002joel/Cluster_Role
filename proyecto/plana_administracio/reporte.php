<?php
include 'conexion.php';

// Consulta para obtener reportes con los nombres de los usuarios
$sql = "
SELECT 
    r.id_report,
    ru.user_name AS reportador,
    rr.user_name AS reportado,
    r.motive,
    r.explanation,
    r.report_date,
    r.resolved,
    r.resolved_date
FROM report r
JOIN usuarios ru ON r.id_user = ru.id_user
JOIN usuarios rr ON r.id_user_reported = rr.id_user
ORDER BY r.report_date DESC";

$result = $conn->query($sql);
$reportes = [];

while ($row = $result->fetch_assoc()) {
    // Asegurarse de que resolved sea un booleano
    $row['resolved'] = (bool) $row['resolved'];
    $reportes[] = $row;
}

// Devolver JSON
echo json_encode($reportes);
$conn->close();
?>
