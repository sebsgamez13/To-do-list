<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Tareas</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="CSS/styles.css">
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Menú lateral -->
            <nav class="col-md-3 col-lg-2 d-md-block bg-light sidebar">
                <div class="sidebar-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav nav-link active" href="index.php?seccion=agregar_tarea">
                                Agregar Tarea
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="index.php?seccion=ver_tareas">
                                Ver Tareas
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Contenido principal -->
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
                <?php
                $seccion = $_GET['seccion'] ?? 'agregar_tarea';
                if ($seccion == 'ver_tareas') {
                    include 'ver_tareas.php';
                } else {
                    include 'agregar_tareas.php';
                }
                ?>
            </main>
        </div>
    </div>
</body>
</html>
