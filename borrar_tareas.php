<?php
require 'conexion.php';

// Verificar si se ha recibido el ID de la tarea a eliminar
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id_tarea = $_GET['id'];

    try {
        // Eliminar la tarea de la base de datos
        $stmt = $pdo->prepare("DELETE FROM task WHERE id = ?");
        $stmt->execute([$id_tarea]);

        // Verificar si la eliminación fue exitosa
        if ($stmt->rowCount() > 0) {
            $mensaje = "Tarea eliminada con éxito.";
            $tipo = "success";
        } else {
            $mensaje = "No se encontró la tarea.";
            $tipo = "error";
        }
    } catch (Exception $e) {
        $mensaje = "Error al eliminar la tarea: " . $e->getMessage();
        $tipo = "error";
    }
} else {
    $mensaje = "ID de tarea inválido.";
    $tipo = "error";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="CSS/styles.css">
</head>
<body>
    <script>
        Swal.fire({
            icon: '<?php echo $tipo; ?>',
            title: '<?php echo $mensaje; ?>',
            confirmButtonText: 'OK'
        }).then(() => {
            window.location.href = 'index.php?seccion=lista_tareas';
        });
    </script>
</body>
</html>
