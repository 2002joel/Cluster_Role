<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cluster_role";

// Connexió
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connexió fallida: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST["title"];
    $version = $_POST["version"];
    $short_explanation = $_POST["short_explanation"];
    $long_explanation = $_POST["long_explanation"];
    $date = date("Y-m-d");

    $stmt = $conn->prepare("INSERT INTO update_log (title, version, short_explanation, long_explanation, date) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $title, $version, $short_explanation, $long_explanation, $date);

    if ($stmt->execute()) {
        header("Location: updates.php");
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Nou Update</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light text-dark">

<div class="container mt-5">
    <h2 class="text-center mb-4">Crear un Nou Update</h2>
    <form method="POST" action="">
        <div class="mb-3">
            <label class="form-label">Títol</label>
            <input type="text" name="title" class="form-control" required />
        </div>
        <div class="mb-3">
            <label class="form-label">Versió</label>
            <input type="text" name="version" class="form-control" required />
        </div>
        <div class="mb-3">
            <label class="form-label">Explicació Curta</label>
            <textarea name="short_explanation" class="form-control" required></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Explicació Llarga</label>
            <textarea name="long_explanation" class="form-control" rows="5" required></textarea>
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-primary">Guardar Update</button>
            <a href="updates.php" class="btn btn-secondary">Cancel·lar</a>
        </div>
    </form>
</div>

</body>
</html>
