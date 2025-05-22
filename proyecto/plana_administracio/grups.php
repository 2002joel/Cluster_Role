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
  <title>Cluster Role - Layout Discord</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="styles.css" />
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
}
  </style>
</head>
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
  
<?php


// Obtener grupos con JOIN al nombre del creador
$query = "
    SELECT 
        g.id_group,
        g.group_name,
        g.creation_date,
        g.profile_photo,
        u.user_name AS nombre_creador
    FROM grupo g
    LEFT JOIN usuarios u ON g.id_creador = u.id_user
    ORDER BY g.id_group ASC
";

$result = $conn->query($query);
?>

<div class="container mt-5">
    <h2 class="text-center mb-4">Listado de Grupos</h2>

    <div class="table-responsive">
      <table class="table table-bordered table-striped align-middle">
        <thead class="table-dark">
          <tr>
            <th>Ver</th>
            <th>ID Grupo</th>
            <th>Nombre</th>
            <th>Creador</th>
            <th>Fecha de Creación</th>
            <th>Foto</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($grupo = $result->fetch_assoc()): ?>
            <tr>
              <td>
                <a href="chat_partida_enviar.php?id_group=<?= $grupo['id_group'] ?>" class="btn btn-sm btn-primary">Ver Chat</a>
              </td>
              <td><?= htmlspecialchars($grupo['id_group']) ?></td>
              <td><?= htmlspecialchars($grupo['group_name']) ?></td>
              <td><?= htmlspecialchars($grupo['nombre_creador'] ?? 'Desconocido') ?></td>
              <td><?= htmlspecialchars($grupo['creation_date']) ?></td>
              <td>
                <?php if ($grupo['profile_photo']): ?>
                  <img src="data:image/jpeg;base64,<?= base64_encode($grupo['profile_photo']) ?>" width="50" height="50" class="rounded-circle" />
                <?php else: ?>
                  <span>Sin foto</span>
                <?php endif; ?>
              </td>
            </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    </div>
  </div>

<?php $conn->close(); ?>

<!-- Panel derecho -->
<aside class="col-md-3 p-3 bg-claro d-flex flex-column justify-content-between align-items-stretch overflow-auto right-panel">

<!-- Caja para Grupos -->
<div class="group-box d-flex justify-content-center align-items-center caja">
<a href="updates.php" >
  <button><h3 class="text-center">Updates</h3></button>
</a>
</div>

<!-- Caja para Amigos -->
<div class="group-box d-flex justify-content-center align-items-center caja">
  <a href="grups.php" >
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
    <span class="titulo">Cluster Role</span> © 2025 - Todos los derechos reservados
  </footer>

</body>
<script>
function actualizarReportes(filtro = "todos") {
  let url = "reporte.php";
  if (filtro !== "todos") {
    url += `?filtro=${filtro}`;
  }

  fetch(url)
    .then(res => res.json())
    .then(data => {
      const contenedor = document.getElementById("tablaReportes");
      contenedor.innerHTML = "";

      const tabla = document.createElement("table");
      tabla.className = "table table-bordered table-striped";
      tabla.innerHTML = `
        <thead>
          <tr>
            <th>Acción</th>
            <th>ID Reporte</th>
            <th>Reportador</th>
            <th>Reportado</th>
            <th>Motivo</th>
            <th>Explicación</th>
            <th>Fecha Reporte</th>
            <th>Resuelto</th>
            <th>Fecha Resolución</th>
          </tr>
        </thead>
        <tbody></tbody>
      `;

      const tbody = tabla.querySelector("tbody");

      data.forEach(r => {
        const fila = document.createElement("tr");
        const resuelto = r.resolved;
        const fechaRes = r.resolved_date ?? "-";

        fila.innerHTML = `
          <td>
            <button class="btn btn-sm ${resuelto ? 'btn-warning' : 'btn-success'}"
                    onclick="cambiarEstadoReporte(${r.id_report}, ${resuelto ? 1 : 0})">
              ${resuelto ? 'No finalizar' : 'Finalizar'}
            </button>
          </td>
          <td>${r.id_report}</td>
          <td>${r.reportador}</td>
          <td>${r.reportado}</td>
          <td>${r.motive}</td>
          <td>${r.explanation}</td>
          <td>${r.report_date}</td>
          <td>${resuelto ? 'Sí' : 'No'}</td>
          <td>${fechaRes}</td>
        `;

        tbody.appendChild(fila);
      });

      contenedor.appendChild(tabla);
    })
    .catch(err => console.error("Error al cargar reportes:", err));
}

function cambiarEstadoReporte(id, estado) {
  const formData = new FormData();
  formData.append("id_report", id);
  formData.append("resolved", estado);

  fetch("cambiar_estado_reporte.php", {
    method: "POST",
    body: formData
  })
    .then(res => res.json())
    .then(data => {
      if (data.success) {
        actualizarReportes(); // recarga
      } else {
        alert("Error al actualizar reporte");
      }
    })
    .catch(err => console.error("Error:", err));
}

// Llamada inicial
actualizarReportes();
</script>


</html>