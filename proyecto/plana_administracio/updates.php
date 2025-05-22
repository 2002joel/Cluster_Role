<?php
$servername = "localhost";  // O el servidor que estés utilizando
$username = "root";         // El nombre de usuario de la base de datos
$password = "";             // La contraseña de la base de datos (si la tienes)
$dbname = "cluster_role"; // El nombre de la base de datos

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener mensajes
$result = $conn->query("SELECT * FROM chat ORDER BY date ASC");
$mensajes = [];
while ($row = $result->fetch_assoc()) {
    $mensajes[] = $row;
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Cluster Role - Updates</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="styles.css" />

</head>
<style>
@font-face {
  font-family: 'Folkard';
  src: url('fonts/Folkard.ttf') format('truetype');
}

.titulo {
  font-family: 'Folkard', cursive;
  background: linear-gradient(to bottom, black 20%, #b30000 100%);
  background-clip: text;                /* estándar /
  -webkit-background-clip: text;        / para WebKit (Chrome, Safari) */
  -webkit-text-fill-color: transparent;
  text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.4);
}</style>

<body class="bg-light text-dark">

  <!-- Header -->
  <header class="bg-rosa-suave border-bottom border-danger py-3 px-4 d-flex justify-content-center align-items-center">
   <div><span><a href="/Cluster_Role/proyecto/plana_administracio/admin.php" class="titulo fw-bold fs-2 text-center" style="text-decoration: none;">Cluster Role</a></span></div>
  </header>


   <!-- HTML -->
  <div class="container-fluid">
    <div class="row vh-100">

      <!-- Sidebar izquierda -->
      <aside class="col-md-3 p-3 bg-claro text-start d-flex flex-column justify-content-start overflow-auto">
      <div id="mensajes" style="overflow-y: scroll; max-height: 400px;">
  <!-- Aquí se cargarán los mensajes con PHP -->
  <?php include 'obtener_mensajes.php'; ?>
</div>
<form action="enviar_mensaje.php" method="POST" class="escribir mt-3" >
      <textarea class="form-control" name="mensaje" rows="3" placeholder="Escribe un mensaje..." required></textarea>
      <button type="submit" class="btn btn-primary mt-2">Enviar</button>
    </form>
  </aside>
  


      <main class="col-md-6 p-4 overflow-auto">
        <div class="container my-5">
            
            <h2 class="text-center my-4">Updates</h2>
            <div style="overflow-y: auto; max-height: 400px;">
              <div id="tablaUpdates"></div>
            </div>
            <div class="text-center mt-4">
  <a href="formulari_update.php" class="btn btn-success">Fer Update</a>
</div>
        
      </main>

<!-- Panel derecho -->
<aside class="col-md-3 p-3 bg-claro d-flex flex-column justify-content-between align-items-stretch overflow-auto right-panel">

<!-- Caja para Grupos -->
<div class="group-box d-flex justify-content-center align-items-center caja">
<a href="updates.php">
  <button><h3 class="text-center">Updates</h3></button>
</a>
</div>

<!-- Caja para Amigos -->
<div class="group-box d-flex justify-content-center align-items-center caja">
  <a href="ver_amigos.php">
  <button><h3 class="text-center">Grups</h3></button>
</a>
</div>

<!-- Caja para Amigos -->
<div class="group-box d-flex justify-content-center align-items-center caja">
  <a href="usuaris.php">
  <button><h3 class="text-center">Usuaris</h3></button>
</a>
</div>

</aside>
    </div>
  </div>
  <!-- Asegúrate de que el script esté enlazado correctamente -->



  <!-- Footer -->
  <footer class="text-center bg-rosa-suave py-2 border-top border-danger">
    Cluster Role © 2025 - Todos los derechos reservados
  </footer>

</body>
<script>

function actualizarUpdates() {
  fetch("update_log.php")
    .then(res => res.json())
    .then(data => {
      const contenedor = document.getElementById("tablaUpdates");
      contenedor.innerHTML = ""; // limpiar

      const tabla = document.createElement("table");
      tabla.classList.add("table", "table-bordered", "table-striped");
      tabla.innerHTML = `
        <thead class="table-light">
          <tr>
            <th>ID Update</th>
            <th>Títol</th>
            <th>Versió</th>
            <th>Explicació Curta</th>
            <th>Explicació Llarga</th>
            <th>Data Update</th>
          </tr>
        </thead>
        <tbody></tbody>
      `;

      const tbody = tabla.querySelector("tbody");

      data.forEach(u => {
        const fila = document.createElement("tr");
        fila.innerHTML = `
        
          <td>${u.id_update}</td>
          <td>${u.title}</td>
          <td>${u.version}</td>
          <td>${u.short_explanation}</td>
          <td>${u.long_explanation}</td>
          <td>${u.date}</td>`;
        tbody.appendChild(fila);
      });

      contenedor.appendChild(tabla);
    })
    .catch(error => {
      console.error("Error al cargar updates:", error);
    });
}

// Llamada inicial
actualizarUpdates();

// Recarga automática cada 5 segundos (opcional)
setInterval(actualizarUpdates, 5000);


</script>
</html>