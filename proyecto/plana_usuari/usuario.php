<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include("conexion.php");

$id_user = $_SESSION['id_user'] ?? 0;
$profile_photo = null;

if ($id_user) {
    $stmt = $conn->prepare("SELECT profile_photo FROM usuarios WHERE id_user = ?");
    $stmt->bind_param("i", $id_user);
    $stmt->execute();
    $stmt->bind_result($profile_photo);
    $stmt->fetch();
    $stmt->close();
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
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <link href="https://fonts.googleapis.com/css2?family=Uncial+Antiqua&display=swap" rel="stylesheet">

<style>
  body, html {
    margin: 0; padding: 0;
    font-family: Arial, sans-serif;
    background: #121212; /* negro profundo */
    color: #c0c0c0; /* gris claro */
    min-height: 100vh;
  }

  header {
    background-color: #1E1E1E; /* gris muy oscuro */
    padding: 1rem 2rem;
    color: #c0c0c0; /* gris claro */
    text-align: center;
    font-size: 1.8rem;
    font-weight: bold;
  }

  main {
    padding: 1.5rem 2rem;
  }

  .btn {
    background-color: #555555; /* gris medio */
    border: none;
    color: #e0e0e0; /* gris muy claro */
    padding: 0.6rem 1.2rem;
    cursor: pointer;
    border-radius: 4px;
    font-weight: 600;
    transition: background-color 0.3s ease;
  }

  .btn:hover {
    background-color: #333333; /* gris oscuro */
  }

  aside {
    background-color: #222222; /* gris oscuro */
    color: #c0c0c0; /* gris claro */
    padding: 1rem;
    margin-top: 1rem;
    border-radius: 4px;
  }

  footer {
    background-color: #1E1E1E; /* gris muy oscuro */
    color: #a0a0a0; /* gris medio */
    text-align: center;
    font-size: 0.9rem;
 
  }

  input, textarea {
    border: 1px solid #666666; /* gris medio */
    border-radius: 4px;
   
    font-size: 1rem;
    color: #f0f0f0; /* gris claro */
    background-color: #333333; /* gris oscuro */
    width: 100%;
    box-sizing: border-box;
    margin-bottom: 1rem;
  }

  input::placeholder, textarea::placeholder {
    color: #999999; /* gris claro */
    font-style: italic;
  }

.titulo {

    font-family: 'Folkard', cursive;
    background: linear-gradient(to bottom, #DAD5C4 10%, #7C1E1E 90%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.8);
  }

</style>

</head>
<body class="text-light" style="background-color: #121212;">

  <header class="border-bottom border-secondary py-3 px-4 d-flex justify-content-center align-items-center" style="background-color: #1E1E1E;">
    <div class="d-flex justify-content-between align-items-center px-4" style="width: 100%; position: relative; max-height: 20vh;">
  <!-- Dropdown a la derecha -->
  <div class="dropdown ms-auto order-2">
  
  <div class="dropdown ms-auto order-2">
    <?php if ($profile_photo): ?>
  <img src="data:image/jpeg;base64,<?= base64_encode($profile_photo) ?>" 
       class="rounded-circle dropdown-toggle"
       id="dropdownMenuButton"
       data-bs-toggle="dropdown"
       aria-expanded="false"
       style="width: 40px; height: 40px; object-fit: cover; cursor: pointer;" />
<?php else: ?>
  <img src="/Cluster_Role/proyecto/foto/icons/default_profile.png"
       class="rounded-circle dropdown-toggle"
       id="dropdownMenuButton"
       data-bs-toggle="dropdown"
       aria-expanded="false"
       style="width: 40px; height: 40px; object-fit: cover; cursor: pointer;" />
<?php endif; ?>
    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton" style="background-color:#222; color: #c0c0c0;">
  <li><a class="dropdown-item" href="configuracio_usuaris.php" style="color:#c0c0c0;">Usuario</a></li>
  <li><a class="dropdown-item" href="reportes.php" style="color:#c0c0c0;">Reportes</a></li>
  <li><a class="dropdown-item" href="logout.php" style="color:#c0c0c0;">Cerrar sesión</a></li>
</ul>

  </div>
  </div>

  <!-- Título centrado con posición absoluta -->
  <div class="position-absolute start-50 translate-middle-x titulo fw-bold fs-2 text-center">
    Cluster Role
  </div>
</div>
  </header>

  <div class="container-fluid">
    <div class="row" style="height: " >

      <!-- Sidebar izquierda -->
      <aside class="col-md-3 p-3 text-start d-flex flex-column justify-content-start overflow-auto" style="background-color: #222222; border-radius: 8px; max-height: 630px">
  <div id="mensajes" style="overflow-y: scroll;  background-color: #555; color: #f0f0f0; padding: 10px; border-radius: 6px;">
    <!-- Aquí se cargarán los mensajes con PHP -->
    <?php include 'obtener_mensajes.php'; ?>
  </div>

  <!-- Formulario para enviar mensaje -->
  <form action="enviar_mensaje.php" method="POST" class="escribir mt-3 d-flex justify-content-center align-items-center flex-column">
    <textarea class="form-control" name="mensaje" rows="3" placeholder="Escribe un mensaje..." required></textarea>
    <button type="submit" class="btn btn-primary mt-2 w-50">Enviar</button>
  </form>
</aside>


      <main class="col-md-6 p-4" style="max-height: 70vh;">
        <div class="banner mb-3">
          <img src="/Cluster_Role/proyecto/foto/photos/foto_update.png" width="100%" height="100%" alt="">
        </div>
<section class="versiones p-3 border rounded" style="max-height: 300px; overflow-y: auto; border-color: #555; background-color: #555555; color: white;">
  <h2 style="text-align: center;">Historial de Versiones</h2>
  <?php include 'mostrar_versiones.php'; ?>
</section>

      </main>

      <!-- Panel derecho -->
      <aside class="col-md-3 p-3 bg-claro d-flex flex-column justify-content-between align-items-stretch overflow-auto right-panel" style="background-color: #222222; max-height: 630px">

        <!-- Caja para Grupos -->
        <div class="group-box">
          <a href="grupos.php">
            <button style="width: 100%; background-color: #555; color: #e0e0e0; border:none;  border-radius: 4px;">
              <h3 class="text-center m-0">Grupos</h3>
            </button>
          </a>

          <div class="card" style="background-color: #333;">
            <div class="card-body" style="color: #c0c0c0;">
              <ul class="list-unstyled" id="lista-grupos">
                <?php include 'datos_grupos.php'; ?>
              </ul>
            </div>
          </div>
        </div>

        <!-- Caja para Personas Relevantes -->
        <div class="group-box mt-3">
          <h3 class="text-center" style="width: 100%; background-color: #555; color:#e0e0e0; border:none; padding: 0.4rem; border-radius: 4px;">Personas Relevantes</h3>
          <div class="card" style="background-color: #333;">
            <div class="card-body" style="color: #c0c0c0;">
              <ul class="list-unstyled" id="lista-relevantes">
                <?php include 'datos_relevantes.php'; ?>
              </ul>
            </div>
          </div>
        </div>

        <!-- Caja para Amigos -->
        <div class="group-box mt-3">
          <a href="ver_amigos.php">
            <button style="width: 100%; background-color: #555; color:#e0e0e0; border:none; padding: 0.4rem; border-radius: 4px;">
              <h3 class="text-center m-0">Amigos</h3>
            </button>
          </a>
          <div class="card" style="background-color: #333;">
            <div class="card-body" style="color: #c0c0c0;">
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
  <footer class="text-center py-2 border-top border-secondary d-flex justify-content-center align-items-center col-md-12" style="background-color: #1E1E1E; color: #888888; height: 10vh;">
    Cluster Role © 2025 - Todos los derechos reservados
  </footer>

</body>
</html>

</body>
</html>


