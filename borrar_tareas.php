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
            // Si la tarea se eliminó, redirigir con un mensaje de éxito
            header("Location: index.php?seccion=lista_tareas&mensaje=Tarea eliminada con éxito.");
        } else {
            // Si no se encontró la tarea, redirigir con un mensaje de error
            header("Location: index.php?seccion=lista_tareas&mensaje=No se encontró la tarea.");
        }
    } catch (Exception $e) {
        // En caso de error, redirigir con el mensaje de error
        header("Location: index.php?seccion=lista_tareas&mensaje=Error al eliminar la tarea: " . $e->getMessage());
    }
} else {
    // Si no se proporciona un ID válido, redirigir con mensaje de error
    header("Location: index.php?seccion=lista_tareas&mensaje=ID de tarea inválido.");
}

exit();
