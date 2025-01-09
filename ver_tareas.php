<?php
require 'conexion.php';

// Consultar las tareas de la tabla 'task' y ordenarlas por fecha límite
$stmt = $pdo->query("SELECT * FROM task ORDER BY fecha_fin ASC");
$tareas = $stmt->fetchAll(PDO::FETCH_ASSOC);

$mensaje = $_GET['mensaje'] ?? '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="CSS/styles.css">
    <title>Document</title>
</head>
<body>
<div class="container mt-4">
    <h2>Lista de Tareas</h2>

    <?php if ($mensaje): ?>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Swal.fire({
                title: 'Mensaje',
                text: "<?php echo htmlspecialchars($mensaje); ?>",
                icon: 'info',
                confirmButtonText: 'Aceptar'
            });
        </script>
    <?php endif; ?>

    <?php if (count($tareas) > 0): ?>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Titulo</th>
                        <th>Descripción</th>
                        <th>Prioridad</th>
                        <th>Fecha Límite</th>
                        <th>Estatus</th>
                        <th>Acciones</th> <!--Se agraga la parte de acciones para el boton de borrar (ya se encuentran los dos corregir estilos de la edicion)--> 
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($tareas as $tarea): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($tarea['titulo']); ?></td>
                            <td><?php echo htmlspecialchars($tarea['descripcion']); ?></td>
                            <td><?php echo htmlspecialchars($tarea['prioridad']); ?></td>
                            <td><?php echo htmlspecialchars($tarea['fecha_fin']); ?></td>
                            <td><?php echo htmlspecialchars($tarea['estatus']); ?></td>
                            <td>
                                <!-- Botón de eliminar que redirige a borrar_tarea.php -->
                                <a href="#" class="btn btn-danger" onclick="confirmarEliminacion(<?php echo $tarea['id']; ?>)">Eliminar</a>

                                    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                                    <script>
                                    function confirmarEliminacion(id) {
                                        Swal.fire({
                                            title: '¿Estás seguro?',
                                            text: "Esta acción no se puede deshacer.",
                                            icon: 'warning',
                                            showCancelButton: true,
                                            confirmButtonColor: '#d33',
                                            cancelButtonColor: '#3085d6',
                                            confirmButtonText: 'Sí, eliminar',
                                            cancelButtonText: 'Cancelar'
                                        }).then((result) => {
                                            if (result.isConfirmed) {
                                                // Redirigir a borrar_tareas.php con el ID
                                                window.location.href = `borrar_tareas.php?id=${id}`;
                                            }
                                        });
                                    }
                                    </script>

                            </td>

                            <td>
                            <!-- Boton para editar la tarea -->
                            <a href="editar_tareas.php?id=<?php echo $tarea['id']; ?>" class="btn btn-warning">Editar</a>
                            </td>

                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <div class="d-flex flex-column align-items-center justify-content-center" style="height: 50vh;">
            <p class="text-center font-weight-bold display-4">No hay tareas registradas.</p>
            <a class="btn btn-primary" href="index.php?seccion=agregar_tarea">Añadir tareas</a>
        </div>
        
    <?php endif; ?>
</div>

</body>
</html>
