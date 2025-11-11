<div class="container my-5 text-center">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="alert alert-success" role="alert">
                <h4 class="alert-heading">¡Matrícula Guardada Exitosamente!</h4>
                <p>Los datos del alumno han sido registrados correctamente en el sistema.</p>
                <hr>
                <p class.mb-0">Puede imprimir la ficha ahora o volver a acceder más tarde.</p>
            </div>
            
            <a href="<?php echo BASE_URL . 'imprimir/' . $idAlumno; ?>" class="btn btn-primary btn-lg" target="_blank">
                🖨️ Imprimir Ficha
            </a>
            
            <a href="<?php echo BASE_URL; ?>" class="btn btn-secondary btn-lg">
                Registrar Otro Alumno
            </a>
        </div>
    </div>
</div>