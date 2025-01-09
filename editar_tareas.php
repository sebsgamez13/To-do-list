<?php
require 'conexion.php';

// Verificar si se ha recibido un ID de tarea válido para editar
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id_tarea = $_GET['id'];

    // Consultar la tarea actual en la base de datos
    $stmt = $pdo->prepare("SELECT * FROM task WHERE id = ?");
    $stmt->execute([$id_tarea]);
    $tarea = $stmt->fetch(PDO::FETCH_ASSOC);

    // Si no se encuentra la tarea, redirigir con mensaje de error
    if (!$tarea) {
        header("Location: index.php?seccion=lista_tareas&mensaje=Tarea no encontrada.");
        exit();
    }
} else {
    // Si no se proporciona un ID válido, redirigir con mensaje de error
    header("Location: index.php?seccion=lista_tareas&mensaje=ID de tarea inválido.");
    exit();
}

// Procesar la actualización cuando el formulario se envía
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $titulo = $_POST['titulo'] ?? '';
    $descripcion = $_POST['descripcion'] ?? '';
    $prioridad = $_POST['prioridad'] ?? '';
    $fecha_limite = $_POST['fecha_limite'] ?? '';
    $estatus = $_POST['estatus'] ?? '';

    // Verificar que todos los campos requeridos sean completados
    if ($titulo && $descripcion && $prioridad && $fecha_limite && $estatus) {
        // Actualizar la tarea en la base de datos
        $stmt = $pdo->prepare("UPDATE task SET titulo = ?, descripcion = ?, prioridad = ?, fecha_fin = ?, estatus = ? WHERE id = ?");
        $stmt->execute([$titulo, $descripcion, $prioridad, $fecha_limite, $estatus, $id_tarea]);

        // Redirigir con mensaje de éxito
        header("Location: index.php?seccion=lista_tareas&mensaje=Tarea actualizada con éxito.");
        exit();
    } else {
        $mensaje_error = "Por favor, complete todos los campos.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Tarea</title>
    <!-- Incluir Bootstrap -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container mt-4">
    <h2>Editar Tarea</h2>

    <!-- Mostrar mensaje de error si no se completan todos los campos -->
    <?php if (isset($mensaje_error)): ?>
        <div class="alert alert-danger"><?php echo $mensaje_error; ?></div>
    <?php endif; ?>

    <form method="POST" action="editar_tareas.php?id=<?php echo $tarea['id']; ?>">
        <div class="form-group">
            <label for="titulo">Título de la Tarea</label>
            <input type="text" class="form-control" id="titulo" name="titulo" value="<?php echo htmlspecialchars($tarea['titulo']); ?>" required>
        </div>
        <div class="form-group">
            <label for="descripcion">Descripción</label>
            <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required><?php echo htmlspecialchars($tarea['descripcion']); ?></textarea>
        </div>
        <div class="form-group">
            <label for="prioridad">Prioridad</label>
            <select class="form-control" id="prioridad" name="prioridad" required>
                <option value="Alta" <?php echo $tarea['prioridad'] == 'Alta' ? 'selected' : ''; ?>>Alta</option>
                <option value="Media" <?php echo $tarea['prioridad'] == 'Media' ? 'selected' : ''; ?>>Media</option>
                <option value="Baja" <?php echo $tarea['prioridad'] == 'Baja' ? 'selected' : ''; ?>>Baja</option>
            </select>
        </div>
        <div class="form-group">
            <label for="fecha_limite">Fecha Límite</label>
            <input type="date" class="form-control" id="fecha_limite" name="fecha_limite" value="<?php echo $tarea['fecha_fin']; ?>" required>
        </div>
        <div class="form-group">
            <label for="estatus">Estatus</label>
            <select class="form-control" id="estatus" name="estatus" required>
                <option value="pendiente" <?php echo $tarea['estatus'] == 'pendiente' ? 'selected' : ''; ?>>Pendiente</option>
                <option value="completa" <?php echo $tarea['estatus'] == 'completa' ? 'selected' : ''; ?>>Completada</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar Tarea</button>
    </form>
</div>

</body>
</html>
