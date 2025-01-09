<?php include("agregar_tareas.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>To do list</title>
</head>
<body>
    <header></header>
    <main class="container">
        <div class="card">
            <div class="card-header">
                Lista de tareas
            </div>
            <div class="card-body">
               
                    <div class="mb-3">
                        <form action="" method="post">
                            <label for="" class="form-label">Nombre</label>
                            <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Escriba el nombre de su tarea"> <br>

                            <input type="button" name="agregar_tarea" id="agregar_tarea" class="btn btn-primary" value="Agregar tarea" type="submit">
                        </form>
                    </div>
                <ul class="list-group">
                    <li class="list-group-item">
                        <input type="checkbox" class="form-check-input float-start" value="" id="" checked>&nbsp; <span class="float-start">Tarea 1</span>
                        <h6 class="float-start">
                            &nbsp; <span class="badge bg-danger">x</span>
                        </h6>
                    </li>

                </ul>
            </div>
            <div class="card-footer text-muted"> foother</div>
        </div>
    </main>





<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>

