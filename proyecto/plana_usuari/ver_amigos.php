<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Cluster Role - Layout Discord</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="styles.css" />
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <style>
    .body, html {
      font-family: 'Georgia', serif;
    }
    .right-panel {
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      height: 100%;
    }
    .group-box {
      flex: 1 1 33%; /* Cada div ocupará un 33% del contenedor */
      margin-bottom: 1rem;
    }
  </style>
</head>
<body class="bg-light text-dark">

  <!-- Header -->
  <header class="bg-rosa-suave border-bottom border-danger py-3 px-4 d-flex justify-content-center align-items-center">
  <div class="d-flex justify-content-between align-items-center">
  <div class="titulo fw-bold fs-2">Cluster Role</div>

  <div class="dropdown">
    <button class="btn btn-light" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
      <i class="bi bi-gear-fill"></i>
    </button>
    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
      <li><a class="dropdown-item" href="#">Usuario</a></li>
      <!-- Puedes añadir más opciones aquí -->
    </ul>
  </div>
</div>

  
  </header>

  <div class="container-fluid">
    <div class="row vh-100">

      <!-- Sidebar izquierda -->
      <aside class="col-md-3 p-3 bg-claro text-start d-flex flex-column justify-content-end overflow-auto">
      <div id="mensajes" style="overflow-y: scroll; max-height: 400px;">
  <!-- Aquí se cargarán los mensajes con PHP -->
  <?php include 'obtener_mensajes.php'; ?>
</div>


    <!-- Formulario para enviar mensaje -->
    <form action="enviar_mensaje.php" method="POST" class="escribir mt-3">
      <textarea class="form-control" name="mensaje" rows="3" placeholder="Escribe un mensaje..." required></textarea>
      <button type="submit" class="btn btn-primary mt-2">Enviar</button>
    </form>
  </aside>

  <main class="col-md-6 p-4">

  <!-- Caja de amigos -->
  <div class="mb-4 p-3 border rounded">
    <h5>👥 Tus amigos</h5>
    <?php include 'obtener_amigos.php'; ?>
  </div>

  <!-- Caja de búsqueda -->
  <div class="p-3 border rounded">
    <h5>🔍 Buscar usuarios</h5>
    <form method="POST" action="">
      <input type="text" name="buscar" placeholder="Buscar por nombre" class="form-control mb-2" required>
      <button type="submit" class="btn btn-primary">Buscar</button>
    </form>
    <div class="mt-3">
      <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["buscar"])) {
          include 'buscar_usuarios.php';
        }
      ?>
    </div>
  </div>

</main>



   <!-- Panel derecho -->
<aside class="col-md-3 p-3 bg-claro d-flex flex-column justify-content-between align-items-stretch overflow-auto right-panel">

<!-- Caja para Grupos -->
<div class="group-box">
<a href="grupos.php" target="_blank">
  <button><h3 class="text-center">Grupos</h3></button>
</a>

  <div class="card">
    <div class="card-body">
      <ul class="list-unstyled" id="lista-grupos">
        <?php include 'datos_grupos.php'; ?>
      </ul>
    </div>
  </div>
</div>

<!-- Caja para Personas Relevantes -->
<div class="group-box">
  <h3 class="text-center">Personas Relevantes</h3>
  <div class="card">
    <div class="card-body">
      <ul class="list-unstyled" id="lista-relevantes">
        <?php include 'datos_relevantes.php'; ?>
      </ul>
    </div>
  </div>
</div>

<!-- Caja para Amigos -->
<div class="group-box">
  <h3 class="text-center">Amigos</h3>
  <div class="card">
    <div class="card-body">
      <ul class="list-unstyled" id="lista-amigos">
        <?php include 'datos_amigos.php'; ?>
      </ul>
    </div>
  </div>
</div>

</aside>

    </div>
  </div>

  <!-- Footer -->
  <footer class="text-center bg-rosa-suave py-2 border-top border-danger">
    Cluster Role © 2025 - Todos los derechos reservados
  </footer>

</body>
</html>