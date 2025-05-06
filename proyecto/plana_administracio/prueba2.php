<?php
session_start();
include 'conexion.php';

// Verificar que el usuario está logueado y que se ha enviado un mensaje
if (isset($_POST['mensaje']) && isset($_SESSION['id_user'])) {
    $id_user = $_SESSION['id_user'];
    $mensaje = mysqli_real_escape_string($conn, $_POST['mensaje']);
    
    // Insertamos el mensaje en la base de datos
    $query = "INSERT INTO chat (id_user, text) VALUES ('$id_user', '$mensaje')";
    mysqli_query($conn, $query);
}

// Redirigimos a la página principal para mostrar los mensajes actualizados
header("Location: admin.php");
exit();
?>