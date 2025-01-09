<?php
require 'conexion.php';

// Consultar las tareas de la tabla 'task' y ordenarlas por fecha límite
$stmt = $pdo->query("SELECT * FROM task ORDER BY fecha_fin ASC");
$tareas = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container mt-4">
    <h2>Lista de Tareas</h2>
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
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <p>No hay tareas registradas.</p>
    <?php endif; ?>
</div>
