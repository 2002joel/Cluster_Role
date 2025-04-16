<?php
// Generar las contraseñas hasheadas
echo "Admin: " . password_hash("admin123", PASSWORD_DEFAULT) . "\n";
echo "Usuario: " . password_hash("usuario123", PASSWORD_DEFAULT);
?>
