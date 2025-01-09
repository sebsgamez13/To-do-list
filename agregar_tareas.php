<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require 'conexion.php';

    // Recuperar datos del formulario
    $titulo = $_POST['titulo'] ?? '';
    $descripcion = $_POST['descripcion'] ?? '';
    $prioridad = $_POST['prioridad'] ?? '';
    $fecha_fin = $_POST['fecha_limite'] ?? '';  // Ajustar el nombre del campo aquí
    $estatus = 'pendiente';

    // Verificar que todos los campos estén completos
    if ($titulo && $descripcion && $prioridad && $fecha_fin) {
        // Preparar consulta SQL
        $stmt = $pdo->prepare("INSERT INTO task (titulo, descripcion, prioridad, fecha_fin, estatus) VALUES (?, ?, ?, ?, ?)");
        if ($stmt->execute([$titulo, $descripcion, $prioridad, $fecha_fin, $estatus])) {
            $mensaje = "Tarea agregada con éxito.";
        } else {
            $mensaje = "Error al agregar la tarea.";
        }
    } else {
        $mensaje = "Por favor, complete todos los campos.";
    }
}
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
    <h2>Agregar Nueva Tarea</h2>
    
    <?php if (isset($mensaje)): ?>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Swal.fire({
                title: 'Resultado',
                text: "<?php echo htmlspecialchars($mensaje); ?>",
                icon: "<?php echo strpos($mensaje, 'éxito') !== false ? 'success' : 'error'; ?>",
                confirmButtonText: 'Aceptar'
            });
        </script>
    <?php endif; ?>
    
    <form method="post" action="index.php?seccion=agregar_tarea">
        <div class="form-group">
            <label for="titulo">Nombre de la Tarea</label> <!-- Cambié el id de 'nombre' a 'titulo' -->
            <input type="text" class="form-control" id="titulo" name="titulo" required>
        </div>
        <div class="form-group">
            <label for="descripcion">Descripción</label>
            <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required></textarea>
        </div>
        <div class="form-group">
            <label for="prioridad">Prioridad</label>
            <select class="form-control" id="prioridad" name="prioridad" required>
                <option value="Alta">Alta</option>
                <option value="Media">Media</option>
                <option value="Baja">Baja</option>
            </select>
        </div>
        <div class="form-group">
            <label for="fecha_limite">Fecha Límite</label> <!-- El nombre del campo sigue siendo 'fecha_limite' -->
            <input type="date" class="form-control" id="fecha_limite" name="fecha_limite" required>
        </div>
        <button type="submit" class="btn btn-primary">Agregar Tarea</button>
    </form>
</div>

</body>
</html>

