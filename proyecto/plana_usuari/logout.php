<?php
session_start();
session_unset();    // Limpia variables de sesión
session_destroy();  // Destruye la sesión

// Redirige al login o página principal
header("Location: /Cluster_Role/proyecto/pagina_main/index.html");
exit();
?>
