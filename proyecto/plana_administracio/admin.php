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

    <aside class="col-md-3 p-3 bg-claro text-start d-flex flex-column justify-content-end overflow-auto">
    <div id="mensajes">
      <!-- Aquí se cargarán los mensajes con PHP -->
      <?php include 'obtener_mensajes.php'; ?>
    </div>

    <!-- Formulario para enviar mensaje -->
    <form action="enviar_mensaje.php" method="POST" class="escribir mt-3">
      <textarea class="form-control" name="mensaje" rows="3" placeholder="Escribe un mensaje..." required></textarea>
      <button type="submit" class="btn btn-primary mt-2">Enviar</button>
    </form>
  </aside>
      <main class="col-md-6 p-4 overflow-auto">
        <div class="container my-5">
            <h2 class="text-center mb-4">Reports</h2>
            <table class="table table-bordered table-striped">
              <thead class="table-light">
                <tr>
                  <th>Descripció</th>
                  <th>De</th>
                  <th>A</th>
                  <th>Motiu</th>
                  <th>Finalitzar</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>No para de dir bajanades</td>
                  <td>Antonio</td>
                  <td>Awesome</td>
                  <td>Comportament ofensiu</td>
                  <td><input type="checkbox" checked disabled></td>
                </tr>
                <tr>
                  <td>És una persona amb poc coeficient intel·lectual</td>
                  <td>Awesome</td>
                  <td>Antonio</td>
                  <td>Altres</td>
                  <td><input type="checkbox" disabled></td>
                </tr>
              </tbody>
            </table>
        
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
</html>