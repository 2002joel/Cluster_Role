<?php
include('conexion.php'); // O también puedes usar require('conexion.php');


// Verificar la conexión
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = htmlspecialchars($_POST['user_name']);
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if (empty($username) || empty($email) || empty($password) || empty($confirm_password)) {
        echo "❌ Todos los campos son obligatorios.";
        exit();
    }

    if ($password !== $confirm_password) {
        echo "❌ Las contraseñas no coinciden.";
        exit();
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    echo "🔐 Hash generado: $hashed_password<br>"; // SOLO PARA PRUEBA

    $stmt = $conn->prepare("SELECT * FROM users WHERE user_name = ? OR email = ? LIMIT 1");
    $stmt->bind_param("ss", $username, $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "❌ El nombre de usuario o correo electrónico ya están en uso.";
    } else {
        $stmt = $conn->prepare("INSERT INTO users (user_name, email, contraseña) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $email, $hashed_password);

        if ($stmt->execute()) {
            echo " Usuario administrador autenticado. Redirigiendo...";
            header("Location: /projecto/login/login.html");
            exit();
        } else {
            echo "❌ Error al registrar el usuario.";
        }
    }
}

?>
