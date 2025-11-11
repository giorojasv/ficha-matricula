<div class="container my-5">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Panel de Administrador</h2>
        <a href="<?php echo BASE_URL; ?>admin/logout" class="btn btn-danger">Cerrar Sesión</a>
    </div>
    <p>Bienvenido, <?php echo htmlspecialchars($_SESSION['user_email']); ?>.</p>
    
    <!-- 
    NUEVA SECCIÓN ESTADÍSTICAS 
    -->
    <h4 class="mt-4">Estadísticas de Matrícula</h4>
    <div class="row">
        <!-- Card Total Alumnos -->
        <div class="col-md-4">
            <div class="card text-white bg-primary mb-3">
                <div class="card-body">
                    <!-- 
                        Esta variable '$totalAlumnos' la envía 
                        el método dashboard() del AdminController.
                    -->
                    <h5 class="card-title"><?php echo $totalAlumnos ?? 0; ?></h5>
                    <p class="card-text">Total Fichas Ingresadas</p>
                </div>
            </div>
        </div>
        
        <!-- Card Conteo por Curso -->
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Alumnos por Curso
                </div>
                <div class="card-body" style="max-height: 200px; overflow-y: auto;">
                    <!-- 
                        Esta variable '$conteoCursos' también 
                        la envía el AdminController.
                    -->
                    <?php if (empty($conteoCursos)): ?>
                        <p class="text-muted">No hay alumnos registrados aún.</p>
                    <?php else: ?>
                        <ul class="list-group list-group-flush">
                            <?php foreach ($conteoCursos as $curso): ?>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <?php echo htmlspecialchars($curso['curso']); ?>
                                    <span class="badge bg-primary rounded-pill">
                                        <?php echo $curso['cantidad']; ?>
                                    </span>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <!-- 
    FIN SECCIÓN ESTADÍSTICAS  
     -->

    <h4>Buscar Ficha de Alumno por RUT</h4>
    <div class="row">
        <div class="col-md-6">
            <form action="<?php echo BASE_URL; ?>admin/buscar" method="POST" class="needs-validation" novalidate>
                <div class="input-group">
                    <input type="text" class="form-control" 
                           name="rut_busqueda" 
                           placeholder="Ingrese RUT del alumno (ej. 12345678-9)" 
                           value="<?php echo $rut_buscado ?? ''; ?>" required>
                    <button class="btn btn-primary" type="submit">Buscar</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Resultados de la Búsqueda -->
    <?php if (isset($alumno)): ?>
        
        <hr class="my-4">
        <h5>Resultado de la Búsqueda</h5>
        
        <?php if ($alumno): // Si $alumno es true (encontrado) ?>
            <div class="alert alert-success">
                <p class="mb-0"><strong>Alumno Encontrado:</strong></p>
                <p><strong>Nombre:</strong> <?php echo htmlspecialchars($alumno['nombre']); ?></p>
                <p><strong>RUT:</strong> <?php echo htmlspecialchars($alumno['rut']); ?></p>
                
                <a href="<?php echo BASE_URL . 'imprimir/' . $alumno['id_alumno']; ?>" 
                   class="btn btn-success btn-sm" 
                   target="_blank">
                   🖨️ Ver / Imprimir Ficha
                </a>
                <a href="<?php echo BASE_URL . 'admin/editar/' . $alumno['id_alumno']; ?>" 
                   class="btn btn-warning btn-sm">
                   ✏️ Editar Alumno
                </a>
                
                <!--  BOTÓN ELIMINA-->
                <a href="<?php echo BASE_URL . 'admin/eliminar/' . $alumno['id_alumno']; ?>" 
                   class="btn btn-danger btn-sm"
                   onclick="return confirm('¿Está seguro de que desea eliminar esta ficha? Esta acción no se puede deshacer.');">
                   🗑️ Eliminar
                </a>
                
            </div>
        <?php else: // Si $alumno es false (no encontrado) ?>
            <div class="alert alert-warning">
                No se encontró ningún alumno con el RUT: <?php echo htmlspecialchars($rut_buscado); ?>
            </div>
        <?php endif; ?>

    <?php endif; ?>

</div>