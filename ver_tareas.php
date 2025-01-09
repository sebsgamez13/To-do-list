<?php
require 'conexion.php';

// Consultar las tareas de la tabla 'task' y ordenarlas por fecha límite
$stmt = $pdo->query("SELECT * FROM task ORDER BY fecha_fin ASC");
$tareas = $stmt->fetchAll(PDO::FETCH_ASSOC);

$mensaje = $_GET['mensaje'] ?? '';
?>

<div class="container mt-4">
    <h2>Lista de Tareas</h2>

    <?php if ($mensaje): ?>
        <div class="alert alert-info"><?php echo htmlspecialchars($mensaje); ?></div>
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
                                <a href="borrar_tareas.php?id=<?php echo $tarea['id']; ?>" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar esta tarea?')">Eliminar</a>
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
        <p>No hay tareas registradas.</p>
    <?php endif; ?>
</div>
