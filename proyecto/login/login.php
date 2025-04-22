<?php
include('conexion.php'); // O también puedes usar require('conexion.php');

if ($conn->connect_error) {
    die(" Error de conexión: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = htmlspecialchars($_POST['user_name'] ?? '');
    $password = $_POST['pass'] ?? '';

    if (empty($username) || empty($password)) {
        echo " El nombre de usuario o la contraseña están vacíos.";
        exit();
    }

    // DEPURACIÓN: Mostrar valores recibidos
    echo "📥 Usuario recibido: $username<br>";

    $stmt = $conn->prepare("SELECT * FROM users WHERE user_name = ? LIMIT 1");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    echo "🔍 Filas encontradas: " . $result->num_rows . "<br>";

    if ($result->num_rows == 1) {
        $usuario = $result->fetch_assoc();

        echo "🔐 Hash guardado: " . $usuario['contraseña'] . "<br>";

        if (!empty($usuario['contraseña']) && password_verify($password, $usuario['contraseña'])) {
            $_SESSION['user_name'] = $usuario['user_name'];
            $_SESSION['id_user'] = $usuario['id_user'];

            if ($usuario['administrador'] == 1) {
                echo " Usuario administrador autenticado. Redirigiendo...";
                header("Location: /proyecto/plana_administracio/admin.html");
                exit();
            } else {
                echo "Usuario normal autenticado. Redirigiendo...";
                header("Location: /proyecto/plana_usuari/usuario.html");
                exit();
            }
        } else {
            echo "Contraseña incorrecta.";
        }
    } else {
        echo "Usuario no encontrado.";
    }
}
?>


