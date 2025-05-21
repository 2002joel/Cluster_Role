<?php
if (isset($_GET['id'])) {
    $id_group = intval($_GET['id']);
    header("Location: grupo.php?id=$id_group"); // Aquí pondrías la página del grupo
    exit;
}
?>
