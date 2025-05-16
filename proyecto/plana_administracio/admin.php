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

</head>
<body class="bg-light text-dark">

  <!-- Header -->
  <header class="bg-rosa-suave border-bottom border-danger py-3 px-4 d-flex justify-content-center align-items-center">
    <div class="titulo fw-bold fs-2">Cluster Role</div>
  </header>

  <div class="container-fluid">
    <div class="row vh-100">

   <!-- HTML -->
  <div class="container-fluid">
    <div class="row vh-100">

      <!-- Sidebar izquierda -->
      <aside class="col-md-3 p-3 bg-claro text-start d-flex flex-column justify-content-end overflow-auto">
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
            <h2 class="text-center mb-4">Reports</h2>

            <div id="tablaReportes"></div>
            
  
        
            <h2 class="text-center my-4">Updates</h2>
            <table class="table table-bordered table-striped">
              <thead class="table-light">
                <tr>
                  <th>Descripció</th>
                  <th>Versió</th>
                  <th>Admin</th>
                  <th>Data</th>
                  <th>Publicat</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Bugs Arreglats</td>
                  <td>3.1.3577</td>
                  <td>Antonio</td>
                  <td>12/02/2025</td>
                  <td><input type="checkbox" checked disabled></td>
                </tr>
                <tr>
                  <td>Nova versió</td>
                  <td>3.1.3578</td>
                  <td>Antonio</td>
                  <td>11/2/2025</td>
                  <td><input type="checkbox" checked disabled></td>
                </tr>
              </tbody>
            </table>
          </div>
        
      </main>

      <!-- Panel derecho -->
      <aside class="col-md-3 p-3 bg-claro d-flex flex-column justify-content-between align-items-stretch overflow-auto right-panel">
        <!-- Caja para Grupos -->
        <div class="group-box">
          <h3 class="text-center ">Grupos</h3>
        
        </div>

        <!-- Caja para Personas Relevantes -->
    

        <!-- Caja para Amigos -->
        <div class="group-box">
          <h3 class="text-center">Usuaris</h3>
     
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
function marcarResuelto(checkbox, id, celdaFecha) {
    if (!checkbox.checked) return;

    if (!confirm("¿Marcar este reporte como resuelto?")) {
        checkbox.checked = false;
        return;
    }

    fetch('resolver.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: 'id_report=' + encodeURIComponent(id)
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            checkbox.disabled = true;
            celdaFecha.textContent = data.resolved_date;
        } else {
            alert("Hubo un error al actualizar.");
            checkbox.checked = false;
        }
    })
    .catch(() => {
        alert("Error de red.");
        checkbox.checked = false;
    });
}

  function actualizarReportes() {
      fetch("reporte.php")
        .then(res => res.json())
        .then(data => {
          const contenedor = document.getElementById("tablaReportes");
          contenedor.innerHTML = ""; // limpiar

          const tabla = document.createElement("table");
          tabla.innerHTML = `
            <tr>
              <th>ID Reporte</th>
              <th>Usuario que Reporta</th>
              <th>Usuario Reportado</th>
              <th>Motivo</th>
              <th>Explicación</th>
              <th>Fecha Reporte</th>
              <th>Resuelto</th>
              <th>Fecha Resolución</th>
            </tr>`;

          data.forEach(r => {
            const fila = document.createElement("tr");

            fila.innerHTML = `
              <td>${r.id_report}</td>
              <td>${r.reportador}</td>
              <td>${r.reportado}</td>
              <td>${r.motive}</td>
              <td>${r.explanation}</td>
              <td>${r.report_date}</td>
              <td></td>
              <td>${r.resolved_date ?? "-"}</td>`;

            const tdCheckbox = fila.children[6];
            if (r.resolved == 1) {
              tdCheckbox.innerHTML = "<input type='checkbox' checked disabled>";
            } else {
              const form = document.createElement("form");
              const inputId = document.createElement("input");
              inputId.type = "hidden";
              inputId.name = "id_report";
              inputId.value = r.id_report;

              const checkbox = document.createElement("input");
              checkbox.type = "checkbox";
              checkbox.addEventListener("change", function () {
                const formData = new FormData();
                formData.append("id_report", r.id_report);
                fetch("resolver.php", {
                  method: "POST",
                  body: formData
                }).then(() => {
                  actualizarReportes();
                });
              });

              form.appendChild(inputId);
              form.appendChild(checkbox);
              tdCheckbox.appendChild(form);
            }

            tabla.appendChild(fila);
          });

          contenedor.appendChild(tabla);
        });
    }

    // Llamada inicial
    actualizarReportes();

    // Recarga periódica cada 5 segundos
    setInterval(actualizarReportes, 5000);
</script>

</html>