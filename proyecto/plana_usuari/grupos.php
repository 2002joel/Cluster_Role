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
    @font-face {
  font-family: 'Folkard';
  src: url('fonts/Folkard.ttf') format('truetype');
}

.titulo {
  font-family: 'Folkard', cursive;
  background: linear-gradient(to bottom, black 20%, #b30000 100%);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.4);
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
<div class="titulo fw-bold fs-2 text-center">Cluster Role</div>
  <div class="dropdown">
    <button class="btn btn-light" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
      <i class="bi bi-gear-fill"></i>
    </button>
    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
      <li><a class="dropdown-item" href="configuracio_usuaris.php">Usuario</a></li>
      <li><a class="dropdown-item" href="reportes.php">Reportes</a></li>
  </div>
</div>

  
  </header>
  <div class="container-fluid">
    <div class="row vh-100">


 <aside class="col-md-3 p-3 bg-claro text-start d-flex flex-column justify-content-start overflow-auto"style="height: 500px; max-height: 80vh;">
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
    <?php include 'mirar_grupos.php'; ?>

    <div class="d-flex gap-4 flex-wrap">
        <?php
        $idModificar = $_GET['modificar'] ?? null;
        $totalGrupos = count($grupos);

        foreach ($grupos as $grupo) {
            $finfo = finfo_open(FILEINFO_MIME_TYPE);

            if (!empty($grupo['profile_photo'])) {
                $mime = finfo_buffer($finfo, $grupo['profile_photo']);
                $fotoBase64 = base64_encode($grupo['profile_photo']);
            } else {
                $mime = 'image/png';
                $fotoBase64 = '';
            }

            finfo_close($finfo);
            $imgSrc = $fotoBase64 ? 'data:' . $mime . ';base64,' . $fotoBase64 : 'ruta/a/imagen_por_defecto.png';

            $id_group = htmlspecialchars($grupo['id_group']);
            $group_name = htmlspecialchars($grupo['group_name']);

            echo '<div>';
            echo '<a href="ver_grupos.php?id=' . $id_group . '" class="text-decoration-none">';
            echo '<div style="width: 150px; height: 150px; border: 2px solid #ccc; border-radius: 10px; overflow: hidden; display: flex; align-items: center; justify-content: center;">';
            echo '<img src="' . $imgSrc . '" alt="' . $group_name . '" style="width: 100%; height: 100%; object-fit: cover;">';
            echo '</div>';
            echo '</a>';

            echo '<div class="mt-2 d-flex justify-content-between">';
            echo '<form action="grupos.php" method="get" style="margin-right: 5px;">';
            echo '<input type="hidden" name="modificar" value="' . $id_group . '">';
            echo '<button type="submit" class="btn btn-sm btn-warning">Modificar</button>';
            echo '</form>';
            echo '<form action="eliminar_grupo.php" method="post" onsubmit="return confirm(\'¿Seguro que quieres eliminar este grupo?\');">';
            echo '<input type="hidden" name="id_group" value="' . $id_group . '">';
            echo '<button type="submit" class="btn btn-sm btn-danger">Eliminar</button>';
            echo '</form>';
            echo '</div>';

            // Mostrar el formulario de modificación si se pulsó
            if ($idModificar == $id_group) {
                echo '<form method="POST" action="modificar_grupo.php" enctype="multipart/form-data" class="mt-3">';
                echo '<input type="hidden" name="id_group" value="' . $id_group . '">';
                echo '<div class="mb-2">';
                echo '<label class="form-label">Nuevo nombre:</label>';
                echo '<input type="text" name="group_name" class="form-control" value="' . $group_name . '" required>';
                echo '</div>';
                echo '<div class="mb-2">';
                echo '<label class="form-label">Nueva imagen (opcional):</label>';
                echo '<input type="file" name="profile_photo" class="form-control">';
                echo '</div>';
                echo '<button type="submit" class="btn btn-success btn-sm">Guardar cambios</button>';
                echo '</form>';
            }

            echo '</div>';
        }

        // Cuadros "+" para crear nuevos grupos
        for ($i = $totalGrupos; $i < 3; $i++) {
            echo '<a href="creacion_grupos.php" class="text-decoration-none">';
            echo '<div style="width: 150px; height: 150px; border: 2px dashed #aaa; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 72px; color: #aaa; font-weight: bold;">+</div>';
            echo '</a>';
        }
        ?>
    </div>
      <h1>Grupos donde estoy</h1>
    <?php include("mostrar_grupos.php"); ?>
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